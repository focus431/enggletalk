@extends('layout.mainlayout')

@section('content')
<div class="container">
    <h2>{{ $type == 'reading' ? __('TOEIC Reading Practice') : __('TOEIC Listening Practice') }}</h2>

    <div id="questions-container">
    <form action="{{ $page == $totalPages ? route('toeic.test.submit', ['type' => $type]) : route('toeic.test', ['type' => $type]) }}" method="{{ $page == $totalPages ? 'POST' : 'GET' }}">
    @csrf

            @if(!empty($previousAnswers))
                @foreach($previousAnswers as $questionId => $answer)
                    <input type="hidden" name="answers[{{ $questionId }}]" value="{{ $answer }}">
                @endforeach
            @endif

            @foreach ($questions as $index => $question)
            <div class="card mb-3">
                <div class="card-body">
                    @if($type == 'reading')
                        <h5>Question {{ ($page - 1) * 10 + $index + 1 }}: {{ $question->question }}</h5>
                    @elseif($type == 'listening')
                        <h5>Question {{ ($page - 1) * 10 + $index + 1 }}:</h5>
                    @endif

                    @if ($type == 'listening')
                    <audio controls>
                        <source src="{{ $question->audio_file }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    @endif

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
                <input type="hidden" name="page" value="{{ $page + 1 }}">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Next Page</button>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
