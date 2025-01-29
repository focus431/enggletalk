@extends('layout.mainlayout')

@section('content')
<div class="container">
    <h2>{{ __('Test Results') }}</h2>

    <!-- 顯示總分數 -->
    <p class="text-center display-6">{{ __('You scored') }} <strong>{{ $score }}</strong></p>

    <!-- 顯示評估結果 -->
    <p class="text-center text-muted">{{ $evaluation }}</p>

    <!-- 顯示答題詳情 -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">{{ __('Question') }}</th>
                    <th class="text-center">{{ __('Your Answer') }}</th>
                    <th class="text-center">{{ __('Correct Answer') }}</th>
                    <th class="text-center">{{ __('Result') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($questions as $question)
                <tr>
                    <td>{{ $question->question }}</td>
                    <td class="text-center">
                        @php
                            $answerKey = $userAnswers[$question->id] ?? null;
                            $yourAnswer = match($answerKey) {
                                'option_a' => $question->option_a,
                                'option_b' => $question->option_b,
                                'option_c' => $question->option_c,
                                'option_d' => $question->option_d,
                                default => __('Not answered')
                            };
                        @endphp
                        {{ $yourAnswer }}
                    </td>
                    <td class="text-center">
                        @php
                            $correctAnswer = match($question->correct_answer) {
                                'option_a' => $question->option_a,
                                'option_b' => $question->option_b,
                                'option_c' => $question->option_c,
                                'option_d' => $question->option_d,
                            };
                        @endphp
                        {{ $correctAnswer }}
                    </td>
                    <td class="text-center">
                        @if ($userAnswers[$question->id] === $question->correct_answer)
                        <span class="badge bg-success">{{ __('Correct') }}</span>
                        @else
                        <span class="badge bg-danger">{{ __('Incorrect') }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 再次測試按鈕 -->
    <div class="text-center">
        <a href="{{ route('toeic.test', ['type' => $type]) }}" class="btn btn-primary btn-lg">{{ __('Try Again') }}</a>
    </div>
    
</div>
@endsection
