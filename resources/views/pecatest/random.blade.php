<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PECA 菲律賓遊學顧問測驗</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* 列印專用樣式 */
        @media print {
            /* 整體字體和行間距縮小 */
            body {
                font-size: 0.7rem; /* 縮小字體大小 */
                line-height: 1.1;   /* 縮小行間距 */
            }
            .container {
                max-width: 100%;    /* 使用全寬，減少頁面邊距 */
                padding: 0;         /* 移除容器的內邊距 */
            }
            .question {
                margin-bottom: 0.2rem; /* 減少每題之間的距離 */
                padding: 0.5rem;       /* 減少每題的內邊距 */
            }
            .option {
                padding: 0.2rem; /* 縮小選項的內邊距 */
            }
            .text-center {
                display: none; /* 隱藏提交按鈕 */
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">PECA 菲律賓遊學顧問測驗</h1>

        <form action="/submit-answers" method="POST" class="bg-white shadow-md rounded-lg px-6 pt-4 pb-6 mb-4">
            @csrf
            @foreach ($questions as $index => $question)
                <div class="question mb-6 p-3 border-b border-gray-300">
                    <p class="text-base font-semibold text-gray-700 mb-3">{{ $index + 1 }}. {{ $question->question_text }}</p>
                    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

                    <div class="grid gap-2 md:grid-cols-2 lg:grid-cols-2">
                        @foreach ($question->options as $option)
                            <div class="option flex items-center bg-gray-100 rounded-lg p-2">
                                <input type="radio" name="questions[{{ $index }}][answer]" value="{{ $option->option_label }}" id="q{{ $index }}_{{ $option->option_label }}" class="mr-2 h-3 w-3 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                <label for="q{{ $index }}_{{ $option->option_label }}" class="text-gray-700 text-sm">{{ $option->option_label }}. {{ $option->option_text }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    提交答案
                </button>
            </div>
        </form>
    </div>
</body>
</html>
