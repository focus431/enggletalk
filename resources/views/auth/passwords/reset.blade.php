@extends('layout.mainlayout')
@section('content')
<!-- Page Content -->
<div class="bg-pattern-style">
    <div class="content">
        <!-- Account Content -->
        <div class="account-content">
            <div class="account-box">
                <div class="login-right">
                    <div class="login-header">
                        <h3>{{ __('auth.reset_password') }}</h3>
                        <p class="text-muted">{{ __('auth.reset_password_subtitle') }}</p>
                    </div>

                    <!-- Reset Password Form -->
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label class="form-control-label">{{ __('auth.email_address') }}</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">{{ __('auth.new_password') }}</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                   required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">{{ __('auth.confirm_password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" 
                                   required autocomplete="new-password">
                        </div>

                        <button class="btn btn-primary login-btn" type="submit">
                            {{ __('auth.reset_password') }}
                        </button>
                    </form>
                    <!-- /Reset Password Form -->
                </div>
            </div>
        </div>
        <!-- /Account Content -->
    </div>
</div>
<!-- /Page Content -->
@endsection 