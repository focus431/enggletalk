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
        <div class="profile-sidebar">
          @include('layout.partials.sidebar', ['completionPercentage' => $completionPercentage])
        </div>
      </div>
      <!-- /Profile Sidebar -->

      <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card">
          <div class="card-body">
            <!-- Profile Settings Form -->
            <form id="profile-form" enctype="multipart/form-data">
              @csrf

              <!-- 個人資訊 -->
              <h4 class="form-section-title">{{ __('Personal') }}</h4>
              <hr>
              <div class="row form-row">
                <div class="col-12 col-md-12">
                  <div class="form-group">
                    <div class="change-avatar">
                      <div class="profile-img"></div>
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
                    <div class="cal-icon">
                      <input type="date" name="date_of_birth" class="form-control datetimepicker"
                        value="{{ $user->date_of_birth }}">
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('Gender') }}</label>
                    <select class="form-control select form-select" name="gender">
                      <option value="Male" {{ ucfirst(strtolower($user->gender)) == 'Male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                      <option value="Female" {{ ucfirst(strtolower($user->gender)) == 'Female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                      <option value="Other" {{ ucfirst(strtolower($user->gender)) == 'Other' ? 'selected' : '' }}>{{ __('Other') }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('Email ID') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('Mobile') }}</label>
                    <input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('City') }}</label>
                    <input type="text" name="city" class="form-control" value="{{ $user->city }}">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('Country') }}</label>
                    <input type="text" name="country" class="form-control" value="{{ $user->country }}">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('Name your classroom') }}</label>
                    <input type="text" name="google_meet_code" class="form-control"
                      value="{{ $user->google_meet_code }}">
                  </div>
                </div>
              </div>

              <!-- 添加課程複選框 -->
              <h4 class="form-section-title">{{ __('Available Courses') }}</h4>
              <hr>
              <div class="row form-row">
                @foreach ($courses as $course)
                <div class="col-12 col-md-6">
                  <div class="form-group form-check">
                    <input type="checkbox" name="courses[]" value="{{ $course->id }}" class="form-check-input"
                      {{ in_array($course->id, $user->courses->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $course->name }}</label>
                  </div>
                </div>
                @endforeach
              </div>

              <!-- 銀行資料 -->
              <h4 class="form-section-title">{{ __('Bank Information') }}</h4>
              <hr>
              <div class="row form-row">
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('Bank Name') }}</label>
                    <input type="text" name="bank_name" class="form-control" value="{{ $user->bank_name }}">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('Branch Name') }}</label>
                    <input type="text" name="branch_name" class="form-control" value="{{ $user->branch_name }}">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('SWIFT Code') }}</label>
                    <input type="text" name="swift_code" class="form-control" value="{{ $user->swift_code }}">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="form-group">
                    <label>{{ __('Account Number') }}</label>
                    <input type="text" name="account_number" class="form-control"
                      value="{{ $user->account_number }}">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('Account Holder Name') }}</label>
                    <input type="text" name="account_holder_name" class="form-control"
                      value="{{ $user->account_holder_name }}">
                  </div>
                </div>
              </div>

              <!-- 教育背景 -->
              <h4 class="form-section-title">{{ __('Education Background') }}</h4>
              <hr>
              <div class="row form-row">
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('Education Background') }}</label>
                    <textarea name="education_background" class="form-control">{{ $user->education_background }}</textarea>
                  </div>
                </div>
              </div>

              <!-- YouTube Embed -->
              <h4 class="form-section-title">{{ __('YouTube Link') }}</h4>
              <hr>
              <div class="row form-row">
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('YouTube Link') }}</label>
                    <input type="text" name="youtube_link" id="youtube_link" class="form-control"
                      value="{{ $user->youtube_link }}">
                    <!-- 預覽區塊 -->
                    <div id="youtube_preview"></div>
                  </div>
                </div>
              </div>

              <!-- 自我介紹 -->
              <h4 class="form-section-title">{{ __('About Me') }}</h4>
              <hr>
              <div class="row form-row">
                <div class="col-12">
                  <div class="form-group">
                    <label>{{ __('About Me') }}</label>
                    <textarea id="about_me_editor" name="about_me" class="form-control">{!! e($user->about_me) !!}</textarea>
                  </div>
                </div>
              </div>

              <!-- 提交按鈕 -->
              <div class="submit-section">
                <button type="button" id="save-changes" class="btn btn-primary submit-btn">{{ __('Save Changes') }}</button>
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
<script src="https://cdn.tiny.cloud/1/jlmmcx7uy41ft2w4cwnwfgbsj2hzglw932fw2pq96d0t5aub/tinymce/5/tinymce.min.js"
  referrerpolicy="origin"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 初始化 TinyMCE
    tinymce.init({
      selector: '#about_me_editor',
      init_instance_callback: function(editor) {
        const editorContent = editor.getContent();
      }
    });

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

    // 處理 YouTube 連結預覽
    function initializeYoutubePreview() {
      const existingYoutubeLink = document.getElementById('youtube_link').value;
      if (existingYoutubeLink) {
        updateYoutubePreview(existingYoutubeLink);
      }
    }

    function updateYoutubePreview(link) {
      const match = link.match(/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?([\w\-]+)/);
      if (match) {
        const embedCode = `<iframe width="560" height="315" src="https://www.youtube.com/embed/${match[1]}" frameborder="0" allowfullscreen></iframe>`;
        document.getElementById('youtube_preview').innerHTML = embedCode;
      } else {
        document.getElementById('youtube_preview').innerHTML = '';
      }
    }

    const youtubeLinkElement = document.getElementById('youtube_link');
    if (youtubeLinkElement) {
      youtubeLinkElement.addEventListener('input', function() {
        updateYoutubePreview(this.value);
      });
    }

    initializeYoutubePreview();

    // 處理表單提交
    const saveChangesBtn = document.getElementById('save-changes');
    if (saveChangesBtn) {
      saveChangesBtn.addEventListener('click', function() {
        const form = document.getElementById('profile-form');
        const formData = new FormData(form);
        
        // 添加 TinyMCE 內容
        const editorContent = tinymce.get('about_me_editor').getContent();
        formData.set('about_me', editorContent);

        // 顯示載入中提示
        saveChangesBtn.disabled = true;
        saveChangesBtn.innerHTML = '{{ __("messages.saving") }}';

        fetch('/profile-settings-mentor', {
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