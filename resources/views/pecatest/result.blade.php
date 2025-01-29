<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>測驗結果</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto py-10 px-4">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">測驗結果</h1>
        <p class="text-xl text-center text-gray-700 mb-10">您的分數是：<span class="font-semibold text-blue-600">{{ $score }}</span>/100</p>

        <div class="bg-white shadow-md rounded-lg p-6 mb-10">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">每題詳解</h2>
            @foreach ($answeredQuestions as $index => $question)
                <div class="question mb-8 p-4 border-b border-gray-300">
                    <p class="text-lg font-semibold text-gray-800 mb-4">{{ $index + 1 }}. {{ $question['question_text'] }}</p>

                    <ul class="mb-4">
                        @foreach ($question['options'] as $label => $option)
                            <li class="flex items-center mb-2">
                                <span class="text-gray-700">{{ $label }}.</span>
                                <span class="ml-2 text-gray-600">{{ $option }}</span>
                            </li>
                        @endforeach
                    </ul>

                    <p class="mb-2">
                        <span class="font-semibold">您的答案：</span>
                        <span class="{{ $question['user_answer'] === $question['correct_answer'] ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                            {{ $question['user_answer'] ?? '未作答' }}
                        </span>
                    </p>
                    <p>
                        <span class="font-semibold">正確答案：</span>
                        <span class="text-blue-600 font-semibold">{{ $question['correct_answer'] }}</span>
                    </p>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="/random-questions" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline">
                重新測驗
            </a>
        </div>
    </div>
</body>
</html>
