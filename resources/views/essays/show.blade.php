@extends('layout.mainlayout')

@section('styles')
<style>
    .essay-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
    }

    .essay-header {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .essay-title {
        color: #0d6efd;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .essay-meta {
        display: flex;
        gap: 1.5rem;
        color: #6c757d;
        font-size: 0.95rem;
    }

    .essay-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .essay-content {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .content-title {
        color: #0d6efd;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e9ecef;
    }

    .score-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .score-card {
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.2s;
        border: 2px solid #e9ecef;
    }

    .score-card:hover {
        transform: translateY(-5px);
    }

    .score-card.grammar {
        border-top: 4px solid #0d6efd;
    }

    .score-card.content {
        border-top: 4px solid #198754;
    }

    .score-card.structure {
        border-top: 4px solid #6f42c1;
    }

    .score-card.vocabulary {
        border-top: 4px solid #ffc107;
    }

    .score-label {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .score-value {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .grammar .score-label { color: #0d6efd; }
    .content .score-label { color: #198754; }
    .structure .score-label { color: #6f42c1; }
    .vocabulary .score-label { color: #ffc107; }

    .feedback-section {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .feedback-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #0d6efd;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e9ecef;
    }

    .feedback-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .feedback-block {
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid #e9ecef;
    }

    .feedback-block h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #495057;
    }

    .feedback-text {
        color: #495057;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back {
        background-color: #f8f9fa;
        color: #495057;
        border: 2px solid #dee2e6;
    }

    .btn-back:hover {
        background-color: #e9ecef;
    }

    .btn-primary {
        background-color: #0d6efd;
        color: white;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }

    .loading-message {
        background-color: #fff3cd;
        border: 1px solid #ffeeba;
        color: #856404;
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        font-weight: 500;
    }

    .success-message {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
        padding: 1rem;
        border-radius: 0.5rem;
        text-align: center;
        font-weight: 500;
        margin-bottom: 1rem;
    }
</style>
@endsection

@section('content')
<div class="essay-container">
    <div class="essay-header">
        <h1 class="essay-title">{{ $essay->title }}</h1>
        <div class="essay-meta">
            <div class="essay-meta-item">
                <i class="far fa-clock"></i>
                <span>{{ __('essays.labels.submit_time') }}：{{ $essay->created_at->format('Y-m-d H:i') }}</span>
            </div>
            <div class="essay-meta-item">
                <i class="far fa-file-alt"></i>
                <span>{{ __('essays.labels.word_count') }}：{{ $essay->word_count }}</span>
            </div>
            <div class="essay-meta-item">
                <i class="far fa-bookmark"></i>
                <span>{{ __('essays.labels.type') }}：{{ __('essays.topic_types.' . $essay->topic_type) }}</span>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    <div class="essay-content">
        <h2 class="content-title">{{ __('essays.labels.original_content') }}</h2>
        <div class="prose max-w-none">
            {!! nl2br(e($essay->content)) !!}
        </div>
    </div>

    @if($essay->correction)
    <div class="score-cards">
        <div class="score-card grammar">
            <div class="score-label">{{ __('essays.scores.grammar') }}</div>
            <div class="score-value">{{ $essay->correction->grammar_score }}</div>
        </div>
        <div class="score-card content">
            <div class="score-label">{{ __('essays.scores.content') }}</div>
            <div class="score-value">{{ $essay->correction->content_score }}</div>
        </div>
        <div class="score-card structure">
            <div class="score-label">{{ __('essays.scores.structure') }}</div>
            <div class="score-value">{{ $essay->correction->structure_score }}</div>
        </div>
        <div class="score-card vocabulary">
            <div class="score-label">{{ __('essays.scores.vocabulary') }}</div>
            <div class="score-value">{{ $essay->correction->vocabulary_score }}</div>
        </div>
    </div>

    <div class="feedback-section">
        <h3 class="feedback-title">{{ __('essays.labels.detailed_feedback') }}</h3>
        <div class="feedback-content">
            <div class="feedback-block">
                <h4>{{ __('essays.feedback.grammar') }}</h4>
                <div class="feedback-text">
                    {!! nl2br(e($essay->correction->{'grammar_corrections_' . app()->getLocale()})) !!}
                </div>
            </div>
            <div class="feedback-block">
                <h4>{{ __('essays.feedback.content') }}</h4>
                <div class="feedback-text">
                    {!! nl2br(e($essay->correction->{'content_suggestions_' . app()->getLocale()})) !!}
                </div>
            </div>
            <div class="feedback-block">
                <h4>{{ __('essays.feedback.vocabulary') }}</h4>
                <div class="feedback-text">
                    {!! nl2br(e($essay->correction->{'vocabulary_suggestions_' . app()->getLocale()})) !!}
                </div>
            </div>
            <div class="feedback-block">
                <h4>{{ __('essays.feedback.overall_feedback') }}</h4>
                <div class="feedback-text">
                    {!! nl2br(e($essay->correction->{'overall_feedback_' . app()->getLocale()})) !!}
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="loading-message">
        {{ __('essays.labels.loading') }}
    </div>
    @endif

    <div class="action-buttons">
        <a href="{{ route('essays.index') }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            {{ __('essays.labels.back_to_list') }}
        </a>
        <a href="{{ route('essays.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            {{ __('essays.labels.write_new') }}
        </a>
    </div>
</div>
@endsection 