@extends('layout.mainlayout')

@section('styles')
<style>
    .essay-form-container {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e9ecef;
    }

    .form-title {
        font-size: 2rem;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 0.5rem;
    }

    .form-subtitle {
        color: #4a5568;
        font-size: 1.1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.95rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #dee2e6;
        border-radius: 0.5rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        outline: none;
    }

    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #dee2e6;
        border-radius: 0.5rem;
        font-size: 1rem;
        background-color: white;
        cursor: pointer;
    }

    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
        outline: none;
    }

    .form-textarea {
        min-height: 300px;
        resize: vertical;
    }

    .word-count {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        font-size: 0.9rem;
        color: #718096;
        background: rgba(255, 255, 255, 0.9);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        border: 1px solid #dee2e6;
    }

    .word-count.warning {
        color: #dc3545;
        border-color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .word-count.success {
        color: #198754;
        border-color: #198754;
        background-color: rgba(25, 135, 84, 0.1);
    }

    .form-hint {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }

    .form-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 2px solid #e9ecef;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .btn-back {
        background-color: #f8f9fa;
        color: #495057;
        border: 2px solid #dee2e6;
    }

    .btn-back:hover {
        background-color: #e9ecef;
        border-color: #ced4da;
    }

    .btn-submit {
        background-color: #0d6efd;
        color: white;
        border: none;
    }

    .btn-submit:hover {
        background-color: #0b5ed7;
        transform: translateY(-1px);
    }

    .btn-submit:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-in {
        animation: fadeIn 0.3s ease-out;
    }

    /* 錯誤提示樣式更新 */
    .bg-red-50 {
        background-color: #fff3f3;
    }

    .border-red-500 {
        border-color: #dc3545;
    }

    .text-red-500 {
        color: #dc3545;
    }

    .text-red-800 {
        color: #842029;
    }

    .text-red-700 {
        color: #b02a37;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-100 py-12">
    <div class="essay-form-container fade-in">
        <div class="form-header">
            <h1 class="form-title">撰寫新作文</h1>
            <p class="form-subtitle">讓 AI 為您提供專業的英文寫作建議</p>
        </div>

        @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">提交時出現以下錯誤：</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ route('essays.store') }}" method="POST" id="essayForm">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">作文標題</label>
                <input type="text" 
                       name="title" 
                       id="title" 
                       class="form-input" 
                       value="{{ old('title') }}" 
                       placeholder="請輸入作文標題..."
                       required>
                <p class="form-hint">好的標題能夠清楚表達文章主旨</p>
            </div>

            <div class="form-group">
                <label for="topic_type" class="form-label">作文類型</label>
                <select name="topic_type" id="topic_type" class="form-select" required>
                    <option value="">請選擇作文類型...</option>
                    <option value="argumentative" {{ old('topic_type') == 'argumentative' ? 'selected' : '' }}>議論文</option>
                    <option value="narrative" {{ old('topic_type') == 'narrative' ? 'selected' : '' }}>記敘文</option>
                    <option value="descriptive" {{ old('topic_type') == 'descriptive' ? 'selected' : '' }}>描寫文</option>
                    <option value="expository" {{ old('topic_type') == 'expository' ? 'selected' : '' }}>說明文</option>
                </select>
                <p class="form-hint">選擇合適的作文類型，AI 將提供更準確的評估和建議</p>
            </div>

            <div class="form-group relative">
                <label for="content" class="form-label">作文內容</label>
                <textarea name="content" 
                          id="content" 
                          class="form-input form-textarea" 
                          placeholder="在此輸入您的作文內容..."
                          required>{{ old('content') }}</textarea>
                <div id="wordCount" class="word-count">0 字</div>
                <p class="form-hint">建議：確保文章結構完整，包含清晰的開頭、主體和結尾</p>
            </div>

            <div class="form-buttons">
                <button type="button" 
                        onclick="window.history.back()" 
                        class="btn btn-back">
                    返回
                </button>
                <button type="submit" 
                        id="submitButton" 
                        class="btn btn-submit" 
                        disabled>
                    提交作文
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contentTextarea = document.getElementById('content');
    const wordCountDisplay = document.getElementById('wordCount');
    const submitButton = document.getElementById('submitButton');
    const titleInput = document.getElementById('title');
    const topicTypeSelect = document.getElementById('topic_type');
    const minWords = 100;

    function countWords(str) {
        str = str.trim();
        return str ? str.split(/\s+/).length : 0;
    }

    function updateFormState() {
        const wordCount = countWords(contentTextarea.value);
        const hasTitle = titleInput.value.trim().length > 0;
        const hasType = topicTypeSelect.value !== '';
        
        // 更新字數顯示
        wordCountDisplay.textContent = `${wordCount} 字`;
        
        // 根據字數更新顯示樣式
        if (wordCount < minWords) {
            wordCountDisplay.className = 'word-count warning';
        } else {
            wordCountDisplay.className = 'word-count success';
        }

        // 更新提交按鈕狀態
        submitButton.disabled = wordCount < minWords || !hasTitle || !hasType;
    }

    // 監聽輸入事件
    contentTextarea.addEventListener('input', updateFormState);
    titleInput.addEventListener('input', updateFormState);
    topicTypeSelect.addEventListener('change', updateFormState);

    // 初始化表單狀態
    updateFormState();
});
</script>
@endsection 