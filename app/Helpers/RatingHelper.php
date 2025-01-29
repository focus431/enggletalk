<?php

namespace App\Helpers;

use App\Models\Review;
use Illuminate\Support\Collection;

class RatingHelper
{
    public static function calculateWeightedAverageRatings(Collection $mentorIds)
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
}