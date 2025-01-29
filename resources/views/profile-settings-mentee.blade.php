<?php $page = 'profile-settings-mentee'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('Profile Settings') }}</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">{{ __('Profile Settings') }}</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- Profile Sidebar -->
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

          <!-- Sidebar -->
          <div class="profile-sidebar">
            @include('layout.partials.sidebar', ['completionPercentage' => $completionPercentage])

          </div>
          <!-- /Sidebar -->

        </div>
        <!-- /Profile Sidebar -->

        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="card">
            <div class="card-body">

              <!-- Profile Settings Form -->
              <form id="profile-form" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf
                <div class="row form-row">
                  <div class="col-12 col-md-12">
                    <div class="form-group">
                      <div class="change-avatar">
                        <div class="profile-img">
                        </div>
                        <div class="upload-img">
                          <div class="change-photo-btn">
                            <span><i class="fa fa-upload"></i> {{ __('Upload Photo') }}</span>
                            <input type="file" name="avatar" class="upload">
                          </div>
                          <small class="form-text text-muted">{{ __('Allowed JPG, GIF or PNG. Max size of 2MB') }}</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('First Name') }}</label>
                      <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('Last Name') }}</label>
                      <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('Date of Birth') }}</label>
                      <div class="1cal-icon">
                        <input type="date" name="date_of_birth" class="form-control datetimepicker"
                          value="{{ $user->date_of_birth }}">
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control select form-select" name="gender">
                        <option value="Male" {{ ucfirst(strtolower($user->gender)) == 'Male' ? 'selected' : '' }}>男
                        </option>
                        <option value="Female" {{ ucfirst(strtolower($user->gender)) == 'Female' ? 'selected' : '' }}>女
                        </option>
                        <option value="Other" {{ ucfirst(strtolower($user->gender)) == 'Other' ? 'selected' : '' }}>其他
                        </option>
                      </select>
                    </div>

                  </div>


                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('Email') }}</label>
                      <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>

                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('Mobile') }}</label>
                      <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
                    </div>
                  </div>
                  {{-- <div class="col-12">
									<div class="form-group">
										<label>{{ __('Address') }}</label>
										<input type="text" name="address" class="form-control" value="{{ $user->address }}">
									</div>
								</div> --}}
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('City') }}</label>
                      <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                    </div>
                  </div>
                  {{-- <div class="col-12 col-md-6">
									<div class="form-group">
										<label>{{ __('State') }}</label>
										<input type="text" name="state" class="form-control" value="{{ $user->state }}">
									</div>
								</div> --}}
                  {{-- <div class="col-12 col-md-6">
									<div class="form-group">
										<label>{{ __('Zip Code') }}</label>
										<input type="text" name="zip_code" class="form-control" value="{{ $user->zip_code }}">
									</div>
								</div> --}}
                  <div class="col-12 col-md-6">
                    <div class="form-group">
                      <label>{{ __('Line_id') }}</label>
                      <input type="text" name="line_id" class="form-control" value="{{ $user->line_id }}">
                    </div>
                  </div>

                </div>
                <div class="submit-section">
                  <button type="button" id="save-changes"
                    class="btn btn-primary submit-btn">{{ __('Save Changes') }}</button>
                </div>
              </form>
              <!-- /Profile Settings Form -->

            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /Page Content -->
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 顯示當前頭像
    const profileImg = document.querySelector('.profile-img');
    if (profileImg) {
      const currentAvatar = '{{ asset("storage/" . ($user->avatar_path ?? "avatars/default.png")) }}';
      profileImg.innerHTML = `<img src="${currentAvatar}" alt="User Image">`;
    }

    // 處理頭像上傳預覽
    const avatarInput = document.querySelector('input[name="avatar"]');
    if (avatarInput) {
      avatarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            profileImg.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
          }
          reader.readAsDataURL(file);
        }
      });
    }

    // 處理表單提交
    const saveChangesBtn = document.getElementById('save-changes');
    if (saveChangesBtn) {
      saveChangesBtn.addEventListener('click', function() {
        const form = document.getElementById('profile-form');
        const formData = new FormData(form);

        // 顯示載入中提示
        saveChangesBtn.disabled = true;
        saveChangesBtn.innerHTML = '{{ __("messages.saving") }}';

        fetch('/profile-settings-mentee', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
          },
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('{{ __("messages.profile_update_success") }}');
            location.reload();
          } else {
            throw new Error(data.message || '{{ __("messages.profile_update_error") }}');
          }
        })
        .catch((error) => {
          alert(error.message || '{{ __("messages.profile_update_error") }}');
        })
        .finally(() => {
          saveChangesBtn.disabled = false;
          saveChangesBtn.innerHTML = '{{ __("Save Changes") }}';
        });
      });
    }
  });
</script>
@endsection
