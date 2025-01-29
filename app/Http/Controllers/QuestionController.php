<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Question;
use PhpOffice\PhpWord\IOFactory;

class QuestionController extends Controller
{
    public function parseWord()
    {
        $filePath = storage_path('app/questions.docx');
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Word file not found'], 404);
        }

        // 使用 PhpWord 解析 Word 文件
        $phpWord = IOFactory::load($filePath);
        $text = '';

        // 提取所有段落文字
        foreach ($phpWord->getSections() as $section) {
            $elements = $section->getElements();
            foreach ($elements as $element) {
                if (method_exists($element, 'getText')) {
                    $text .= $element->getText() . "\n";
                }
            }
        }

        // 檢查提取的文本

        // 將提取的文字傳遞給 extractQuestions 方法
        $questions = $this->extractQuestions($text);

        // 將題目數據批量插入資料庫
        foreach ($questions as $questionData) {
            if (!isset($questionData['question_text'], $questionData['correct_answer'], $questionData['options'])) {
                continue; // 跳過格式不正確的題目
            }

            // 插入問題
            $question = Question::create([
                'question_text' => $questionData['question_text'],
                'category' => $questionData['category'],
                'correct_answer' => $questionData['correct_answer'],
            ]);

            // 插入選項
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create($optionData);
            }
        }

        return response()->json(['message' => 'Word data successfully saved to database']);
    }

    // 定義 extractQuestions 方法
    private function extractQuestions($text)
{
    $lines = explode("\n", $text);
    $questions = [];
    $currentQuestion = null;
    $currentCategory = ''; // 初始化分類變量
    $buffer = ''; // 用於緩存問題的完整文字

    foreach ($lines as $line) {
        $line = trim($line);

        // 檢測並更新題目分類（例如 ### EG）
        if (preg_match('/^###\s+(\w+)$/', $line, $matches)) {
            $currentCategory = $matches[1];
            continue; // 跳過此行
        }

        // 檢測題目開始的行，例如 "1. EG Academy 成立於哪一年？"
        if (preg_match('/^\d+\.\s+(.*)$/', $line, $matches)) {
            // 如果有上一題的緩存，將其保存
            if ($currentQuestion && isset($currentQuestion['question_text'])) {
                $questions[] = $currentQuestion;
            }
            // 開始新的題目
            $currentQuestion = [
                'question_text' => $matches[1],
                'category' => $currentCategory,
                'correct_answer' => '',
                'options' => [],
            ];
            continue; // 跳過到下一行
        }

        // 檢測選項 (A, B, C, D)
        elseif (preg_match('/^(A|B|C|D)\.\s+(.*)$/', $line, $matches)) {
            if ($currentQuestion) {
                $currentQuestion['options'][] = [
                    'option_text' => $matches[2],
                    'option_label' => $matches[1],
                ];
            }
            continue;
        }

        // 檢測正確答案，例如 "**正確答案：B**"
        elseif (preg_match('/^\*\*正確答案：\s*([A-D])\*\*$/u', $line, $matches)) {
            if ($currentQuestion) {
                $currentQuestion['correct_answer'] = $matches[1];
            }
            continue;
        }
    }

    // 確保最後一題也被添加到陣列中
    if ($currentQuestion && isset($currentQuestion['question_text'])) {
        $questions[] = $currentQuestion;
    }

    return $questions;
}




public function getRandomQuestions()
{
    // 從資料庫中隨機選取 100 道題目，並載入每個題目的選項
    $questions = Question::with('options')
                 ->inRandomOrder()
                 ->limit(100)
                 ->get();

    // 將題目傳遞到 Blade 檢視
    return view('pecatest.random', compact('questions'));
}



public function submitAnswers(Request $request)
{
    $score = 0;
    $answeredQuestions = [];

    // 遍歷所有提交的答案
    foreach ($request->questions as $submitted) {
        $question = Question::find($submitted['id']);

        // 檢查是否有選擇答案
        $userAnswer = $submitted['answer'] ?? null;
        
        // 計算分數
        if ($question && $userAnswer === $question->correct_answer) {
            $score++;
        }

        // 將詳細資訊加入到 $answeredQuestions 陣列中
        if ($question) {
            $answeredQuestions[] = [
                'question_text' => $question->question_text,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->correct_answer,
                'options' => $question->options->pluck('option_text', 'option_label')->toArray(),
            ];
        }
    }

    // 將分數和詳細回答資訊存入 Session
    return redirect()->route('result')
        ->with('score', $score)
        ->with('answeredQuestions', $answeredQuestions);
}



public function showResult(Request $request)
{
    // 從 Session 中獲取分數和回答的題目詳細資料
    $score = $request->session()->get('score', 0); // 預設分數為 0
    $answeredQuestions = $request->session()->get('answeredQuestions', []);

    // 顯示結果頁面
    return view('pecatest.result', compact('score', 'answeredQuestions'));
}


}
