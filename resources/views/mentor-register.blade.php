<?php $page = 'mentor-register'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Page Content -->
  <div class="content" style="min-height: 27px;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 offset-md-4">

          <!-- Account Content -->
          <div class="account-content">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-12 col-lg-6 login-right">
                <div class="login-header">
                  <h3>{{ __('messages.mentor_register') }} <a href="mentee-register">{{ __('messages.not_a_mentor') }}</a>
                  </h3>
                </div>

                <!-- Register Form -->
                <form id="mentor-register-form">
                  @csrf

                  <!-- Email Field -->
                  <div class="form-group form-focus">
                    <input type="email" name="email" class="form-control floating" autocomplete="email">
                    <label class="focus-label">{{ __('messages.email') }}</label>
                  </div>

                  <!-- Password Field -->
                  <div class="form-group form-focus">
                    <input type="password" name="password" class="form-control floating" autocomplete="new-password">
                    <label class="focus-label">{{ __('messages.password') }}</label>
                  </div>

                  <!-- Confirm Password Field -->
                  <div class="form-group form-focus">
                    <input type="password" name="confirm-password" class="form-control floating"
                      autocomplete="new-password">
                    <label class="focus-label">{{ __('messages.confirm_password') }}</label>
                  </div>

                  <!-- Already have an account Link -->
                  <div class="text-end">
                    <a class="forgot-link" href="login">{{ __('messages.already_have_an_account') }}</a>
                  </div>

                  <!-- Signup Button -->
                  <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">{{ __('messages.signup') }}</button>

                  <!-- Login with Google, Hotmail, and Apple Buttons -->
                  <div class="login-or">
                    <span class="or-line"></span>
                    <span class="span-or">{{ __('messages.or') }}</span>
                  </div>
                  <div class="row form-row social-login">
                    <div class="col-12 mb-2">
                      <a href="{{ route('google.login', ['role' => 'mentor']) }}" class="btn btn-google btn-block w-100">
                        <i class="fab fa-google me-1"></i> {{ __('messages.login_with_google') }}
                      </a>
                    </div>
                    <div class="col-12 mb-2">
                      <a href="{{ route('microsoft.login', ['role' => 'mentor']) }}"
                        class="btn btn-microsoft btn-block w-100">
                        <i class="fab fa-windows me-1"></i> {{ __('messages.login_with_hotmail') }}
                      </a>
                    </div>
                  </div>
                  <!-- /Login with Google, Hotmail, and Apple Buttons -->

                  <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response-mentor">
                </form>

                <!-- /Register Form -->

              </div>
            </div>
          </div>
          <!-- /Account Content -->

        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->
@endsection

@section('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('recaptcha.api_site_key') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('mentor-register-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('recaptcha.api_site_key') }}', {action: 'register'})
                .then(function(token) {
                    document.getElementById('g-recaptcha-response-mentor').value = token;
                    const formData = new FormData(form);
                    formData.append('browserLang', navigator.language || navigator.userLanguage);
                    
                    fetch('/mentor-register', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.activation_message);
                            window.location.href = '/login';
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('註冊過程中發生錯誤，請稍後再試。');
                    });
                });
        });
    });
});
</script>
@endsection
