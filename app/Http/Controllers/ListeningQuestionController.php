<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListeningQuestion;

class ListeningQuestionController extends Controller
{
    // 顯示 TOEIC 聽力測驗頁面，分頁顯示題目
    public function toeicListeningPage(Request $request)
    {
        $page = $request->input('page', 1);
        $previousAnswers = $request->input('answers', []);

        // 每页获取 10 道隨機題目，並顯示音檔
        $questions = ListeningQuestion::inRandomOrder()->skip(($page - 1) * 10)->take(10)->get();

        return view('toeic-listening', [
            'questions' => $questions,
            'page' => $page,
            'totalPages' => 3,  // 30道题，每頁10道，共3頁
            'previousAnswers' => $previousAnswers,
        ]);
    }

    // 提交答案並評分
    public function submitAnswers(Request $request)
    {
        $userAnswers = $request->input('answers'); 
        $score = 0;
        $total = count($userAnswers);

        // 获取用戶提交的題目的詳細信息
        $questions = ListeningQuestion::whereIn('id', array_keys($userAnswers))->get();

        foreach ($questions as $question) {
            if ($userAnswers[$question->id] === $question->correct_answer) {
                $score++;
            }
        }

        $evaluation = $this->evaluateScore($score, $total);

        return redirect()->route('toeic.listening.results')->with([
            'score' => $score,
            'total' => $total,
            'evaluation' => $evaluation,
            'questions' => $questions,
            'userAnswers' => $userAnswers
        ]);
    }

    private function evaluateScore($score, $total)
    {
        $percentage = ($score / $total) * 100;

        if ($percentage >= 90) {
            return __('messages.evaluation_advanced');
        } elseif ($percentage >= 70) {
            return __('messages.evaluation_intermediate');
        } elseif ($percentage >= 50) {
            return __('messages.evaluation_improvement');
        } else {
            return __('messages.evaluation_practice');
        }
    }

    public function showResults()
    {
        $score = session('score');
        $total = session('total');
        $evaluation = session('evaluation');
        $questions = session('questions');
        $userAnswers = session('userAnswers');

        if (!$score || !$total || !$evaluation || !$questions || !$userAnswers) {
            return redirect('/toeic-listening'); 
        }

        return view('listening-results', [
            'score' => $score,
            'total' => $total,
            'evaluation' => $evaluation,
            'questions' => $questions,
            'userAnswers' => $userAnswers
        ]);
    }
}
