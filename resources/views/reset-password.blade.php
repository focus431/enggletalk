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

                    <!-- 錯誤訊息顯示區域 -->
                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                    
                    <!-- 成功訊息顯示區域 -->
                    <div id="success-message" class="alert alert-success" style="display: none;"></div>
                    
                    <!-- Reset Password Form -->
                    <form id="resetPasswordForm">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="form-group">
                            <label class="form-control-label">{{ __('auth.email_address') }}</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label">{{ __('auth.new_password') }}</label>
                            <div class="pass-group">
                                <input type="password" name="password" class="form-control pass-input" required>
                                <span class="fas fa-eye toggle-password"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-control-label">{{ __('auth.confirm_password') }}</label>
                            <div class="pass-group">
                                <input type="password" name="password_confirmation" class="form-control pass-input" required>
                                <span class="fas fa-eye toggle-password"></span>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary login-btn" type="submit">{{ __('auth.reset_password') }}</button>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetPasswordForm');
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');

    // 密碼顯示切換
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // 清除之前的訊息
        errorMessage.style.display = 'none';
        successMessage.style.display = 'none';

        const formData = new FormData(form);

        fetch('/password/reset', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData,
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                successMessage.textContent = data.message;
                successMessage.style.display = 'block';
                // 重置成功後延遲跳轉到登入頁面
                setTimeout(() => {
                    window.location.href = '/login';
                }, 2000);
            } else {
                errorMessage.textContent = data.message;
                errorMessage.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorMessage.textContent = '{{ __("auth.system_error") }}';
            errorMessage.style.display = 'block';
        });
    });
});
</script>
@endsection 