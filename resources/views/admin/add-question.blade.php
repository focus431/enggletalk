<!-- resources/views/admin/add-question.blade.php -->

@extends('layout.mainlayout')

@section('content')
<div class="container">
  <h2>{{ __('Add New Question') }}</h2>

  <form action="{{ route('admin.storeQuestion') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="question">{{ __('Question') }}</label>
      <input type="text" class="form-control" id="question" name="question" required>
    </div>

    <div class="form-group">
      <label for="option_a">{{ __('Option A') }}</label>
      <input type="text" class="form-control" id="option_a" name="option_a" required>
    </div>

    <div class="form-group">
      <label for="option_b">{{ __('Option B') }}</label>
      <input type="text" class="form-control" id="option_b" name="option_b" required>
    </div>

    <div class="form-group">
      <label for="option_c">{{ __('Option C') }}</label>
      <input type="text" class="form-control" id="option_c" name="option_c" required>
    </div>

    <div class="form-group">
      <label for="option_d">{{ __('Option D') }}</label>
      <input type="text" class="form-control" id="option_d" name="option_d" required>
    </div>

    <div class="form-group">
      <label for="correct_answer">{{ __('Correct Answer') }}</label>
      <select class="form-control" id="correct_answer" name="correct_answer" required>
        <option value="option_a">{{ __('Option A') }}</option>
        <option value="option_b">{{ __('Option B') }}</option>
        <option value="option_c">{{ __('Option C') }}</option>
        <option value="option_d">{{ __('Option D') }}</option>
      </select>
    </div>

    <div class="form-group">
      <label for="difficulty_level">{{ __('Difficulty Level') }}</label>
      <input type="text" class="form-control" id="difficulty_level" name="difficulty_level">
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
  </form>
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
</div>
@endsection
