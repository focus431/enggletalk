@extends('layout.mainlayout')
@section('content')
<!-- Page Content -->
<div class="bg-pattern-style">
	<div class="content">
		<!-- Login Tab Content -->
		<div class="account-content">
			<div class="account-box">
				<div class="login-right">
					<div class="login-header">
						<h3>Login <span>{{ __('MENTORING') }}</span></h3>
						<p class="text-muted">{{ __('Access to our dashboard') }}</p>
					</div>
					<div id="login-page"></div>
					
					<!-- 錯誤訊息顯示區域 -->
					<div id="error-message" class="alert alert-danger" style="display: none;"></div>
					
					<!-- 登入限制訊息 -->
					<div id="attempts-message" class="alert alert-warning" style="display: none;"></div>

					@if(session('logout_reason'))
						<div class="alert alert-warning">
							{{ session('logout_reason') }}
						</div>
					@endif

					<form id="loginForm">
						@csrf
						<div class="form-group">
							<label class="form-control-label">{{ __('Email Address') }}</label>
							<input name="email" type="email" class="form-control" autocomplete="email">
						</div>
						<div class="form-group">
							<label class="form-control-label">{{ __('Password') }}</label>
							<div class="pass-group">
								<input name="password" type="password" class="form-control pass-input" autocomplete="current-password">
								<span class="fas fa-eye toggle-password"></span>
							</div>
						</div>
						<div class="text-end">
							<a class="forgot-link" href="forgot-password">{{ __('Forgot Password') }} ?</a>
						</div>
						<button class="btn btn-primary login-btn" type="submit">{{ __('Login') }}</button>
						<div class="text-center dont-have">{{ __("Don't have an account") }}? <a href="mentee-register">{{ __('Register') }}</a></div>
					</form>
				</div>
			</div>
		</div>
		<!-- /Login Tab Content -->
	</div>
</div>
<!-- /Page Content -->
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
	const loginForm = document.getElementById('loginForm');
	const errorMessage = document.getElementById('error-message');
	const attemptsMessage = document.getElementById('attempts-message');

	loginForm.addEventListener('submit', function(event) {
		event.preventDefault();

		// 清除之前的錯誤訊息
		errorMessage.style.display = 'none';
		attemptsMessage.style.display = 'none';

		const formData = new FormData(loginForm);

		fetch('/login', {
			method: 'POST',
			headers: {
				'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
				'Accept': 'application/json',
				'X-Requested-With': 'XMLHttpRequest'
			},
			body: formData,
			credentials: 'same-origin'
		})
		.then(response => {
			if (!response.ok) {
				throw new Error('Network response was not ok');
			}
			return response.json();
		})
		.then(data => {
			if (data.success) {
				if (data.redirect) {
					window.location.href = data.redirect;
				} else if (data.role === 'mentee') {
					window.location.href = '/profile-settings-mentee';
				} else if (data.role === 'mentor') {
					window.location.href = '/profile-settings-mentor';
				}
			} else {
				// 顯示錯誤訊息
				errorMessage.textContent = data.message || '登入失敗';
				errorMessage.style.display = 'block';

				// 顯示剩餘嘗試次數
				if (data.attempts_remaining !== undefined) {
					attemptsMessage.textContent = `登入失敗，您還有 ${data.attempts_remaining} 次嘗試機會`;
					attemptsMessage.style.display = 'block';
				}

				// 如果帳號被鎖定，禁用登入按鈕
				const submitButton = loginForm.querySelector('button[type="submit"]');
				if (data.locked) {
					submitButton.disabled = true;
					errorMessage.textContent = '帳號已被鎖定，請稍後再試';
				}
			}
		})
		.catch(error => {
			console.error('Error:', error);
			errorMessage.textContent = '系統錯誤，請稍後再試';
			errorMessage.style.display = 'block';
		});
	});

	// 密碼顯示切換
	const togglePassword = document.querySelector('.toggle-password');
	const passwordInput = document.querySelector('.pass-input');
	
	if (togglePassword && passwordInput) {
		togglePassword.addEventListener('click', function() {
			const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
			passwordInput.setAttribute('type', type);
			this.classList.toggle('fa-eye-slash');
		});
	}
});
</script>
@endsection
