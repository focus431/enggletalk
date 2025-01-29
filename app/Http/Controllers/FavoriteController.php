<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $mentorId = $request->input('mentor_id');
        $userId = Auth::id();

        // 检查是否已经存在这个收藏
        $favorite = Favorite::where('user_id', $userId)
            ->where('mentor_id', $mentorId)
            ->first();

        if ($favorite) {
            // 如果收藏已存在，则删除（取消收藏）
            $favorite->delete();
            return response()->json(['success' => true, 'is_favorited' => false]);
        } else {
            // 如果收藏不存在，则创建（添加收藏）
            Favorite::create([
                'user_id' => $userId,
                'mentor_id' => $mentorId,
                'status' => 'active' // 可以根据需要设置状态
            ]);
            return response()->json(['success' => true, 'is_favorited' => true]);
        }
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



    public function showFavourites()
    {
        // 获取当前用户的收藏项，并加载相关的 Mentor 数据
        $favorites = Auth::user()->favorites()->with('mentor')->paginate(10);
        // 获取导师的ID数组
        $mentorIds = $favorites->pluck('mentor.id')->toArray();

        // 计算导师的加权平均评分
        $averageRatings = $this->calculateWeightedAverageRatings($mentorIds);

        // 为每个收藏项生成加密的 Mentor ID，并附加加权平均评分
        $favorites->each(function ($favorite) use ($averageRatings) {
            $favorite->encryptedMentorId = encrypt($favorite->mentor->id);
            $favorite->mentor->average_rating = $averageRatings[$favorite->mentor->id] ?? 5;
        });

        return view('favourites', ['favorites' => $favorites]);
    }
}
