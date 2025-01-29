<?php

namespace App\Http\Controllers;

// app/Http/Controllers/DashboardMenteeController.php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSchedule;
use App\Models\OrderPlan;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{



    public function mentee_index()
{
    // 確保登入者的角色是 'mentee'
    if (Auth::user() && Auth::user()->role == 'mentee') {
        $userId = Auth::id();

        // 獲取用戶數據，包括剩餘課程數
        $user = User::where('id', $userId)->first(['t_expired', 'remaining_classes']);
        
        if ($user && $user->t_expired) {
            $expiredDate = $user->t_expired->format('y/m/d');
        } else {
            $expiredDate = '';
        }

        $remainingClasses = $user->remaining_classes;

        // 從 ClassSchedule 資料表中獲取各種狀態的課程數據
        $bookedSchedules = ClassSchedule::where('mentee_id', $userId)
            ->where('status', 'booked')
            ->where('schedule_date', '>=', now()->format('Y-m-d'))
            ->orderBy('schedule_date', 'asc')
            ->get();
            
        $completedSchedules = ClassSchedule::where('mentee_id', $userId)
            ->where('status', 'completed')
            ->get();
            
        $absentSchedules = ClassSchedule::where('mentee_id', $userId)
            ->where('status', 'absent')
            ->get();

        // 獲取數據
        $bookedCount = $bookedSchedules->count();
        $completedCount = $completedSchedules->count();
        $absentCount = $absentSchedules->count();

        // 獲取月度統計
        $bookedMonthly = ClassSchedule::where('mentee_id', $userId)
                                      ->where('status', 'booked')
                                      ->select(DB::raw("count(*) as count"), DB::raw("MONTH(schedule_date) as month"))
                                      ->groupBy('month')
                                      ->get();

        $completedMonthly = ClassSchedule::where('mentee_id', $userId)
                                         ->where('status', 'completed')
                                         ->select(DB::raw("count(*) as count"), DB::raw("MONTH(schedule_date) as month"))
                                         ->groupBy('month')
                                         ->get();

        // 將數據和筆數傳遞給視圖
        return view('dashboard_mentee', [
            'bookedSchedules' => $bookedSchedules, 
            'completedSchedules' => $completedSchedules,
            'absentSchedules' => $absentSchedules,
            'bookedCount' => $bookedCount,
            'completedCount' => $completedCount,
            'absentCount' => $absentCount,
            'remaining' => $remainingClasses,  // 确保剩余课程数量正确传递
            't_expired' => $expiredDate,
            'bookedMonthly' => $bookedMonthly,
            'completedMonthly' => $completedMonthly,
            'lessons' => $remainingClasses // 使用剩余课程数量作为 lessons 传递
        ]);
    }

    // 如果用戶角色不是 'mentee'，則重定向到首頁或顯示錯誤訊息
    return redirect('/')->with('error', 'Access Denied');
}








public function mentor_index()
{
    // 確保登入者的角色是 'mentor'
    if (Auth::user() && Auth::user()->role == 'mentor') {
        $userId = Auth::id();

        // 獲取各種狀態的課程數據
        $bookedSchedules = ClassSchedule::where('user_id', $userId)->where('status', 'booked')->get();
        $completedSchedules = ClassSchedule::where('user_id', $userId)->where('status', 'completed')->get();
        $absentSchedules = ClassSchedule::where('user_id', $userId)->where('status', 'absent')->get();
        $remainingClasses = User::where('id', $userId)->pluck('remaining_classes')->first();

        // 獲取數據
        $bookedCount = $bookedSchedules->count();
        $completedCount = $completedSchedules->count();
        $absentCount = $absentSchedules->count();

        // 獲取月度統計
        $bookedMonthly = ClassSchedule::where('user_id', $userId)
                                      ->where('status', 'booked')
                                      ->select(DB::raw("count(*) as count"), DB::raw("MONTH(schedule_date) as month"))
                                      ->groupBy('month')
                                      ->get();

        $completedMonthly = ClassSchedule::where('user_id', $userId)
                                         ->where('status', 'completed')
                                         ->select(DB::raw("count(*) as count"), DB::raw("MONTH(schedule_date) as month"))
                                         ->groupBy('month')
                                         ->get();

        // 計算不同 mentee 的數量
        $distinctUserCount = ClassSchedule::where('user_id', $userId)
                                          ->distinct('mentee_id')
                                          ->count('mentee_id');

        // 將數據和計數值傳遞給視圖
        return view('dashboard_mentor', [
            'bookedSchedules' => $bookedSchedules, 
            'completedSchedules' => $completedSchedules, 
            'absentSchedules' => $absentSchedules,
            'bookedCount' => $bookedCount,
            'completedCount' => $completedCount,
            'absentCount' => $absentCount,
            'remaining' => $remainingClasses,
            'distinctUserCount' => $distinctUserCount,
            'bookedMonthly' => $bookedMonthly,
            'completedMonthly' => $completedMonthly
        ]);
    }

    // 如果用戶角色不是 'mentor'，則重定向到首頁或顯示錯誤訊息
    return redirect('/')->with('error', 'Access Denied');
}






}
