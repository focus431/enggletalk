@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Viewing Log: {{ $filename }}</h1>
    <pre style="background-color: #f8f9fa; padding: 10px;">
        {{ $content }}
    </pre>
    <a href="{{ route('log-viewer.index') }}">Back to Logs</a>
</div>
@endsection
