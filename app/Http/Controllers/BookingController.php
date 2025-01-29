<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\StatusChangedNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\App; // 用於多語系支持
use App\Mail\AbsentNotification; 
use App\Mail\BookingConfirmation;
use App\Models\Booking;
class BookingController extends Controller
{
    // 更新用户的时区
    public function updateTimezone(Request $request)
    {
        $request->validate([
            'timezone' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user && $user instanceof User) {
            $user->timezone = $request->input('timezone');
            $user->save();

            return response()->json(['message' => 'Timezone updated successfully.']);
        }

        return response()->json(['error' => 'User not authenticated or not valid'], 401);
    }

    // 新增：更新用户的语言设置
    public function updateLanguage(Request $request)
    {
        $request->validate([
            'language' => 'required|string|in:zh_TW,zh_CN,en,ja,ko,vi',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => '請先登入'], 401);
        }

        $user->preferred_language = $request->input('language');
        $user->save();

        return response()->json(['message' => '語言更新成功']);
    }




    
    // 检查剩余课程数量
    public function checkRemainingClasses(Request $request)
    {
        $userId = $request->input('userId');
        $user = User::find($userId);

        if ($user) {
            return response()->json(['remaining_classes' => $user->remaining_classes]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // 显示导师信息
    public function show($encryptedUserId)
    {
        try {
            $mentor_id = decrypt($encryptedUserId);
        } catch (\Exception $e) {
            abort(404, 'Invalid user ID');
        }

        $mentor = User::find($mentor_id);

        if (!$mentor) {
            abort(404, 'Mentor not found');
        }

        return view('booking', ['mentor' => $mentor]);
    }

    // 获取课程安排
    public function getClassSchedule(Request $request, $mentorId)
    {
        $schedules = ClassSchedule::where('user_id', $mentorId)->get();
        $timezone = $request->query('timezone', 'UTC');

        $convertedSchedules = $schedules->map(function ($schedule) use ($timezone) {
            $schedule->start_time = $this->convertToLocalTime($schedule->schedule_date, $schedule->start_time, $timezone);
            $schedule->end_time = $this->convertToLocalTime($schedule->schedule_date, $schedule->end_time, $timezone);
            return $schedule;
        });

        return response()->json($convertedSchedules);
    }

    // 将UTC时间转换为本地时间
    private function convertToLocalTime($date, $time, $timezone)
    {
        $dateTime = new \DateTime("{$date} {$time}", new \DateTimeZone('UTC'));
        $dateTime->setTimezone(new \DateTimeZone($timezone));
        return $dateTime->format('H:i:s');
    }














    // 更新课程状态
    public function updateBookingStatus(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                Log::warning('Booking status update failed: User not authenticated');
                return response()->json(['message' => '請先登入'], 401);
            }

            // 記錄請求數據
            Log::info('Booking status update request:', [
                'user_id' => $user->id,
                'request_data' => $request->all()
            ]);

            // 驗證請求數據
            $validated = $request->validate([
                'classScheduleId' => 'required|exists:class_schedules,id',
                'newStatus' => 'required|string|in:booked,available',
                'menteeId' => 'required|exists:users,id',
                'mentorId' => 'required|exists:users,id'
            ]);

            DB::beginTransaction();
            try {
                // 先鎖定用戶記錄並檢查課程數
                $mentee = DB::table('users')
                    ->where('id', $request->input('menteeId'))
                    ->lockForUpdate()
                    ->first();

                if (!$mentee) {
                    throw new \Exception('找不到用戶');
                }

                // 記錄用戶當前狀態
                Log::info('User current status:', [
                    'user_id' => $mentee->id,
                    'remaining_classes' => $mentee->remaining_classes
                ]);

                // 獲取用戶當前已預約的課程數
                $bookedCount = ClassSchedule::where('mentee_id', $request->input('menteeId'))
                    ->where('status', 'booked')
                    ->where('schedule_date', '>=', now()->format('Y-m-d'))
                    ->count();

                Log::info('Current booked classes:', ['count' => $bookedCount]);

                // 檢查是否超過剩餘課程數
                if ($request->input('newStatus') === 'booked' && 
                    $mentee->remaining_classes <= $bookedCount) {
                    throw new \Exception('剩餘課程數不足');
                }

                // 鎖定課程記錄
                $classSchedule = ClassSchedule::where('id', $request->input('classScheduleId'))
                    ->lockForUpdate()
                    ->first();

                if (!$classSchedule) {
                    throw new \Exception('找不到課程');
                }

                // 記錄課程當前狀態
                Log::info('Class schedule current status:', [
                    'schedule_id' => $classSchedule->id,
                    'current_status' => $classSchedule->status,
                    'current_mentee_id' => $classSchedule->mentee_id
                ]);

                // 檢查課程狀態是否已被修改
                if ($request->input('newStatus') === 'booked' && $classSchedule->status !== 'available') {
                    throw new \Exception('課程已被預約');
                }

                // 更新課程狀態
                $oldStatus = $classSchedule->status;
                $oldMenteeId = $classSchedule->mentee_id;
                
                // 處理預約課程的情況
                if ($request->input('newStatus') === 'booked' && $oldStatus === 'available') {
                    // 使用原子操作更新剩餘課程數
                    $updated = DB::table('users')
                        ->where('id', $request->input('menteeId'))
                        ->where('remaining_classes', '>', 0)
                        ->update([
                            'remaining_classes' => DB::raw('remaining_classes - 1'),
                            'updated_at' => now()
                        ]);
                    
                    if (!$updated) {
                        throw new \Exception('剩餘課程數更新失敗');
                    }

                    // 更新課程狀態
                    $classSchedule->status = 'booked';
                    $classSchedule->mentee_id = $request->input('menteeId');
                    $classSchedule->save();
                    
                    Log::info('Booking successful:', [
                        'user_id' => $request->input('menteeId'),
                        'schedule_id' => $classSchedule->id,
                        'new_status' => 'booked'
                    ]);
                } 
                // 處理取消課程的情況
                elseif ($oldStatus === 'booked' && $request->input('newStatus') === 'available') {
                    if ($oldMenteeId) {
                        // 使用原子操作增加剩餘課程數
                        $updated = DB::table('users')
                            ->where('id', $oldMenteeId)
                            ->update([
                                'remaining_classes' => DB::raw('remaining_classes + 1'),
                                'updated_at' => now()
                            ]);
                            
                        if (!$updated) {
                            throw new \Exception('剩餘課程數更新失敗');
                        }

                        // 更新課程狀態
                        $classSchedule->status = 'available';
                        $classSchedule->mentee_id = null;
                        $classSchedule->save();
                        
                        // 獲取老師和學生的資訊
                        $mentor = User::find($classSchedule->user_id);
                        $mentee = User::find($oldMenteeId);
                        
                        // 發送取消通知郵件給老師
                        if ($mentor) {
                            Mail::to($mentor->email)->send(new StatusChangedNotification(
                                $classSchedule,
                                $mentor,
                                $mentee,
                                $this->convertToLocalTime($classSchedule->schedule_date, $classSchedule->start_time, $mentor->timezone ?? 'UTC'),
                                $this->convertToLocalTime($classSchedule->schedule_date, $classSchedule->end_time, $mentor->timezone ?? 'UTC')
                            ));
                        }
                        
                        // 發送取消通知郵件給學生
                        if ($mentee) {
                            Mail::to($mentee->email)->send(new StatusChangedNotification(
                                $classSchedule,
                                $mentee,
                                $mentor,
                                $this->convertToLocalTime($classSchedule->schedule_date, $classSchedule->start_time, $mentee->timezone ?? 'UTC'),
                                $this->convertToLocalTime($classSchedule->schedule_date, $classSchedule->end_time, $mentee->timezone ?? 'UTC')
                            ));
                        }
                        
                        Log::info('Cancellation successful:', [
                            'user_id' => $oldMenteeId,
                            'schedule_id' => $classSchedule->id,
                            'new_status' => 'available'
                        ]);
                    }
                }

                DB::commit();

                // 記錄最終狀態
                Log::info('Transaction completed successfully', [
                    'schedule_id' => $classSchedule->id,
                    'final_status' => $classSchedule->status,
                    'final_mentee_id' => $classSchedule->mentee_id
                ]);

                return response()->json([
                    'message' => $this->getResponseMessage($request->input('newStatus')),
                    'remaining_classes' => DB::table('users')
                        ->where('id', $request->input('menteeId'))
                        ->value('remaining_classes')
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Transaction failed:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }
        } catch (\Exception $e) {
            Log::error('Booking status update failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['message' => '更新失敗：' . $e->getMessage()], 500);
        }
    }











    // 将本地时间转换为UTC时间
    private function convertToUTCTime($date, $time, $timezone)
    {
        $dateTime = new \DateTime("{$date} {$time}", new \DateTimeZone($timezone));
        $dateTime->setTimezone(new \DateTimeZone('UTC'));
        return $dateTime->format('H:i:s');
    }

    // 根据状态返回响应消息
    private function getResponseMessage($status)
    {
        switch ($status) {
            case 'booked':
                return '預訂確認成功';
            case 'completed':
                return '課程已標記為完成';
            case 'absent':
                return '學員標記為缺席';
            case 'canceled':
                return '預訂已成功取消';
            case 'available':
                return '時段已設為可用';
            default:
                return '狀態已更新';
        }
    }

    // 批量更新课程状态
    public function batchUpdate(Request $request)
    {
        $slots = $request->input('slots');

        DB::beginTransaction();

        try {
            foreach ($slots as $slot) {
                $mentorId = $slot['mentorId'];
                $scheduleDate = $slot['scheduleDate'];
                $startTime = $this->convertToUTCTime($slot['scheduleDate'], $slot['startTime'], $slot['timezone'] ?? 'UTC');
                $endTime = $this->convertToUTCTime($slot['scheduleDate'], $slot['endTime'], $slot['timezone'] ?? 'UTC');
                $newStatus = $slot['newStatus'];
                $menteeId = $slot['menteeId'];

                $classSchedule = ClassSchedule::where('user_id', $mentorId)
                    ->where('schedule_date', $scheduleDate)
                    ->where('start_time', $startTime)
                    ->where('end_time', $endTime)
                    ->first();

                if (!$classSchedule) {
                    DB::rollback();
                    return response()->json(['message' => 'Time slot not found'], 404);
                }

                $classSchedule->status = $newStatus;
                $classSchedule->mentee_id = $menteeId;
                $classSchedule->save();
            }

            DB::commit();
            return response()->json(['message' => 'Successfully updated']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'An error occurred'], 500);
        }
    }

    public function store(Request $request)
    {
        // 儲存預約資料...
        $booking = Booking::create($request->all());
        
        // 發送確認郵件
        Mail::to($booking->mentee->email)->send(new BookingConfirmation(
            $booking,
            $booking->mentor,
            $booking->mentee
        ));
        
        return response()->json(['message' => '預約成功！確認郵件已發送']);
    }
}