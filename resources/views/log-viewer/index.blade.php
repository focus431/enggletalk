@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Log Files</h1>
    <ul>
        @foreach($files as $file)
            <li>
                <a href="{{ route('log-viewer.show', basename($file)) }}">
                    {{ basename($file) }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
