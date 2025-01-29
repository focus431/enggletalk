<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Log;
use App\Models\Review;

class SearchMentorController extends Controller
{
    public function index()
{
    // 獲取分頁的mentors
    $paginatedMentors = User::where('role', 'mentor')->paginate(2); // 2個每頁
    $courses = Course::all()->map(function ($course) {
        $course->name = __($course->name); // 确保翻译名称
        return $course;
    });

    

    // 獲取並加密所有mentor IDs
    $mentorIds = $paginatedMentors->pluck('id');
    $encryptedMentorIds = array_map(function ($id) {
        return encrypt($id);
    }, $mentorIds->toArray());

    // 為每個mentor計算加權平均評分
    $averageRatings = $this->calculateWeightedAverageRatings($mentorIds);

    // 將所有數據傳遞給視圖
    return view('search', [
        'paginatedMentors' => $paginatedMentors,
        'courses' => $courses,
        'encryptedMentorIds' => json_encode($encryptedMentorIds),
        'averageRatings' => $averageRatings,
    ]);
}





    private function calculateWeightedAverageRatings($mentorIds)
    {
        $averageRatings = [];
        $baseRating = 5; // 基准分数
        $deductionPerFiveLowRatings = 0.1; // 每五个低于5分的评分扣0.1分
    
        foreach ($mentorIds as $mentorId) {
            $reviews = Review::where('mentor_id', $mentorId)
                             ->where('created_at', '>=', now()->subDays(90))
                             ->get();
    
            if ($reviews->isEmpty()) {
                $averageRatings[$mentorId] = $baseRating;
                continue;
            }
    
            $lowRatingCount = 0;
    
            foreach ($reviews as $review) {
                if ($review->rating < $baseRating) {
                    $lowRatingCount++;
                }
            }
    
            $totalDeductions = floor($lowRatingCount / 5) * $deductionPerFiveLowRatings;
            $finalRating = max($baseRating - $totalDeductions, 0.1); // 确保最终评分不小于 0.1
    
            $averageRatings[$mentorId] = round($finalRating, 1); // 四舍五入到一位小数
        }
    
        return $averageRatings;
    }
    





    


    public function getMentors(Request $request)
{
    // 在導師查詢中增加 activated 條件
    $query = User::where('role', 'mentor')->where('activated', 1);

    if ($request->has('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->has('courses')) {
        $courseIds = $request->courses;
        $query->whereHas('courses', function ($q) use ($courseIds) {
            $q->whereIn('course_id', $courseIds);
        });
    }

    if ($request->has('date')) {
        $query->whereHas('classSchedules', function ($q) use ($request) {
            $q->whereDate('schedule_date', $request->date);
        });
    }

    if ($request->has('name')) {
        $name = $request->name;
        $query->where(function ($query) use ($name) {
            $query->where('first_name', 'like', '%' . $name . '%')
                  ->orWhere('last_name', 'like', '%' . $name . '%');
        });
    }

    // 進行分頁
    $paginatedMentors = $query->paginate(12);  // 每頁顯示 12 條數據

    $mentorIds = $paginatedMentors->pluck('id');
    $encryptedMentorIds = array_map(function ($id) {
        return encrypt($id);
    }, $mentorIds->toArray());

    // 返回 JSON 響應
    return response()->json([
        'mentors' => $paginatedMentors->items(),
        'encryptedMentorIds' => $encryptedMentorIds,
        'pagination' => [
            'total' => $paginatedMentors->total(),
            'per_page' => $paginatedMentors->perPage(),
            'current_page' => $paginatedMentors->currentPage(),
            'last_page' => $paginatedMentors->lastPage(),
        ]
    ]);
}

}
