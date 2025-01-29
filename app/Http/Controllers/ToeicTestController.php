<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReadingQuestion;
use App\Models\ListeningQuestion;

class ToeicTestController extends Controller
{
    public function showTestPage(Request $request, $type)
{
    $page = $request->input('page', 1); // 當前頁數，默認為第1頁
    $previousAnswers = $request->input('answers', []); // 前一頁的答案

    // 確定測試類型
    if (!in_array($type, ['reading', 'listening'])) {
        return redirect()->back()->with('error', 'Invalid test type.');
    }

    // 隨機選取 30 題
    if ($type == 'reading') {
        $allQuestions = ReadingQuestion::inRandomOrder()->take(30)->get();
    } else {
        $allQuestions = ListeningQuestion::inRandomOrder()->take(30)->get();
    }

    // 確保題目分為 3 頁，每頁 10 題
    $questionsPerPage = 10; // 每頁問題數量
    $totalPages = 3; // 總共 3 頁
    if ($page > $totalPages || $page < 1) {
        return redirect()->back()->with('error', 'Invalid page number.');
    }

    // 分割問題集合，取出當前頁的問題
    $questions = collect($allQuestions)->forPage($page, $questionsPerPage);

    // 傳遞數據到視圖
    return view('toeic-test', [
        'questions' => $questions,
        'page' => $page,
        'totalPages' => $totalPages,
        'previousAnswers' => $previousAnswers,
        'type' => $type
    ]);
}



    public function submitTestAnswers(Request $request, $type)
    {
        $userAnswers = $request->input('answers');
        $score = 0;
        $total = count($userAnswers);

        if ($type == 'reading') {
            $questions = ReadingQuestion::whereIn('id', array_keys($userAnswers))->get();
        } elseif ($type == 'listening') {
            $questions = ListeningQuestion::whereIn('id', array_keys($userAnswers))->get();
        } else {
            return redirect()->back()->with('error', 'Invalid test type.');
        }

        foreach ($questions as $question) {
            if ($userAnswers[$question->id] === $question->correct_answer) {
                $score++;
            }
        }

        $evaluation = $this->evaluateScore($score, $total);

        return redirect()->route('toeic.results')->with([
            'score' => $score,
            'total' => $total,
            'evaluation' => $evaluation,
            'questions' => $questions,
            'userAnswers' => $userAnswers,
            'type' => $type // 傳遞類型到結果頁面
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
    $type = session('type'); // 傳遞測驗類型

    if (!$score || !$total || !$evaluation || !$questions || !$userAnswers) {
        return redirect()->route('toeic.test', ['type' => 'reading']); 
    }

    return view('results', [
        'score' => $score,
        'total' => $total,
        'evaluation' => $evaluation,
        'questions' => $questions,
        'userAnswers' => $userAnswers,
        'type' => $type // 傳遞類型
    ]);
}


}
