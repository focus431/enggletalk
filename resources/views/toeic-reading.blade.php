@extends('layout.mainlayout')

@section('content')
<div class="container">
    <h2>{{ __('TOEIC Reading Practice') }}</h2>

    <div id="questions-container">
        <!-- 显示分页题目 -->
        <form action="{{ $page == $totalPages ? route('toeic.reading.submit') : url('/toeic-reading') }}" method="{{ $page == $totalPages ? 'POST' : 'GET' }}">
            @csrf

            <!-- 保留之前页的答案 -->
            @if(!empty($previousAnswers))
                @foreach($previousAnswers as $questionId => $answer)
                    <input type="hidden" name="answers[{{ $questionId }}]" value="{{ $answer }}">
                @endforeach
            @endif

            @foreach ($questions as $index => $question)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Question {{ ($page - 1) * 10 + $index + 1 }}: {{ $question->question }}</h5>
                    <ul class="list-unstyled">
                        <li>
                            <input type="radio" id="question_{{ $index }}_a" name="answers[{{ $question->id }}]" value="option_a" required>
                            <label for="question_{{ $index }}_a">A: {{ $question->option_a }}</label>
                        </li>
                        <li>
                            <input type="radio" id="question_{{ $index }}_b" name="answers[{{ $question->id }}]" value="option_b" required>
                            <label for="question_{{ $index }}_b">B: {{ $question->option_b }}</label>
                        </li>
                        <li>
                            <input type="radio" id="question_{{ $index }}_c" name="answers[{{ $question->id }}]" value="option_c" required>
                            <label for="question_{{ $index }}_c">C: {{ $question->option_c }}</label>
                        </li>
                        <li>
                            <input type="radio" id="question_{{ $index }}_d" name="answers[{{ $question->id }}]" value="option_d" required>
                            <label for="question_{{ $index }}_d">D: {{ $question->option_d }}</label>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach

            @if ($page == $totalPages)
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit Answers</button>
                </div>
            @else
                <!-- 下一页操作使用 GET -->
                <input type="hidden" name="page" value="{{ $page + 1 }}">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Next Page</button>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
