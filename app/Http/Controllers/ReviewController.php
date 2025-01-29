<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    DB::beginTransaction(); // 開始事務

    try {
        // 验证请求数据
        $validatedData = $request->validate([
            'classschedule_id' => 'required|integer|exists:class_schedules,id', // 更新字段名
            'mentee_id' => 'required|integer|exists:users,id', // 验证 mentee_id
            'rating' => 'required|numeric',
            'comment' => 'nullable|string',
        ]);

        // 从 ClassSchedule 中获取对应的记录
        $classSchedule = ClassSchedule::findOrFail($validatedData['classschedule_id']); // 更新字段名

        // 使用 ClassSchedule 的 user_id 作为 mentor_id
        $mentorId = $classSchedule->user_id;

        // 检查评论是否存在，不存在则创建，存在则更新
        Review::updateOrCreate(
            [
                'classschedule_id' => $classSchedule->id, // 更新字段名
                'mentor_id' => $mentorId, // 从 ClassSchedule 获取 mentor_id
                'mentee_id' => $validatedData['mentee_id'], // 保存 mentee_id
            ],
            [
                'rating' => $validatedData['rating'],
                'comment' => $validatedData['comment'] ?? ''
            ]
        );

        // 更新课程状态为 'Completed'
        $classSchedule->status = 'Completed';
        $classSchedule->save();

        DB::commit(); // 提交事務

        return redirect()->back()->with('success', '評論提交成功，課程狀態已更新。');
    } catch (\Exception $e) {
        DB::rollBack(); // 錯誤發生時回滾事務
        Log::error('Review storing failed: ' . $e->getMessage()); // 記錄錯誤信息
        return redirect()->back()->with('error', '提交評論時發生錯誤。');
    }
}



public function getReviewsByClassScheduleId($mentorId)
{
    Log::info("Mentor ID: " . $mentorId);
    
    // 獲取評論數據
    $reviews = Review::where('mentor_id', $mentorId)->get();
    Log::info($reviews);

    // 將數據轉化為 JSON 格式並返回
    return response()->json($reviews);
}


}

