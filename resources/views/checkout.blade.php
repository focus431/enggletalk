<?php $page = 'checkout'; ?>
@extends('layout.mainlayout')
@section('content')
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title">Checkout</h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <!-- Payment Method Card -->
          <div class="card">
            <div class="card-body">
              <!-- Checkout Form -->
              <form id="checkout-form" action="{{ route('submit-purchasing') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- CSRF Token -->
                <!-- 隐藏用户信息 -->
                <input type="hidden" id="last_name" name="last_name" value="{{ $user->last_name }}">
                <input type="hidden" id="first_name" name="first_name" value="{{ $user->first_name }}">
                <input type="hidden" id="selected_plan" name="selected_plan" value="{{ $plan->name }}">
                <input type="hidden" id="lessons" name="lessons" value="{{ $plan->lessons }}">
                <input type="hidden" id="price" name="price" value="{{ $plan->price }}">
                <input type="hidden" id="duration" name="duration" value="{{ $plan->duration }}">
                <input type="hidden" id="expiry_date" name="expiry_date" value="{{ $plan->expiry_date }}">
                <input type="hidden" name="timezoneOffset" id="timezoneOffset">
                <!-- 隐藏字段，用于传递 UTC 时间 -->
                <input type="hidden" name="utc_time" id="utc-time">
                <!-- 隐藏字段，用于传递位置 -->
                <input type="hidden" name="location" id="location">
                
                <!-- /隐藏用户信息 -->
            
                <div class="payment-widget">
                    <h4 class="card-title">Payment Method</h4>
                    <!-- Bank Transfer Payment -->
                    <div class="payment-list">
                        <label class="payment-radio bank-transfer-option">
                            <input type="radio" name="payment_option" checked="checked" onclick="togglePaymentOption('bank_transfer_details')">
                            <span class="checkmark"></span>
                            Bank Account
                        </label>
                        <div id="bank_transfer_details" class="payment-details">
                            <div class="card-body">
                                <div>Bank Code: 013</div>                
                                <div>Name of Beneficiary: 格仲國際有限公司</div>
                                <div>Beneficiary Account Number: 123456789</div>
                            </div>
                            <div class="form-group">
                                <label for="bank_transfer_proof">Upload Payment Proof</label>
                                <input type="file" class="form-control" id="bank_transfer_proof" name="bank_transfer_proof" accept="image/*">
                                <img id="proof_preview" style="max-width: 100%; margin-top: 10px; display: none;">
                            </div>
                        </div>
                    </div>
                    <!-- /Bank Transfer Payment -->
            
                    <!-- Terms Accept -->
                    <div class="terms-accept">
                        <div class="custom-checkbox">
                            <input type="checkbox" id="terms_accept" required>
                            <label for="terms_accept">I have read and accepted <a href="#">Terms & Conditions</a></label>
                        </div>
                    </div>
                    <!-- /Terms Accept -->
            
                    <!-- Submit Section -->
                    <div class="submit-section mt-4">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                    <!-- /Submit Section -->
                </div>
            </form>
            
              <!-- /Checkout Form -->
            </div>
          </div>
          <!-- /Payment Method Card -->
        </div>

        <div class="col-md-4">
          <!-- Booking Summary -->
          <div class="card booking-card">
            <div class="card-header">
              <h4 class="card-title">Booking Summary</h4>
            </div>
            <div class="card-body">
              <!-- Booking Mentee Info -->
              <div class="booking-user-info">
                <a href="payment-mentee" class="booking-user-img">
                  <img src="assets/img/user/user2.jpg" alt="User Image">
                </a>
                <div class="booking-info">
                  <h4><a href="payment-mentee">{{ $user->last_name }},{{ $user->first_name }}</a></h4>
                  <div class="rating">
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star filled"></i>
                    <i class="fas fa-star"></i>
                    <span class="d-inline-block average-rating">35</span>
                  </div>
                  <div class="mentor-details">
                    <!-- 在页面中显示位置 -->
<p class="user-location"><i class="fas fa-map-marker-alt"></i> <span id="display-location">Locating...</span></p>
                  </div>
                </div>
              </div>
              <!-- /Booking Mentee Info -->

              <!-- Booking Details -->
              <div class="booking-summary">
                <div class="booking-item-wrap">
                  <ul class="booking-date">
                    <li>Date：<span id="local-date"></span></li>
                    <li>Time：<span id="local-time"></span></li>
                  </ul>

                
                
                
                
                  <ul class="booking-fee">
                    <li>Plan <span>{{ $plan->name }}</span></li>
                    <li>Lessons <span>{{ $plan->lessons }}</span></li>
                    <li>Price/class <span>
                      @if ($plan->lessons > 0)
                        {{ intdiv($plan->price, $plan->lessons) }}
                      @else
                        0
                      @endif
                    </span></li>
                  
                  </ul>
                  <div class="booking-total">
                    <ul class="booking-total-list">
                      <li>
                        <span>Total Amount</span>
                        <span class="total-cost">{{ $plan->price }}</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- /Booking Details -->
            </div>
          </div>
          <!-- /Booking Summary -->
        </div>
      </div>
    </div>
  </div>
  <!-- /Page Content -->
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 获取当前本地时间
    const localTime = new Date();

    // 打印本地时间用于调试
    console.log("Local Time: ", localTime);

    // 格式化本地时间为字符串，使用24小时制 zh-TW
    const dateString = localTime.toLocaleDateString('zh-TW', { year: 'numeric', month: 'numeric', day: 'numeric' });
    const timeString = localTime.toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit', hour12: false });

    // 显示在页面上
    document.getElementById('local-date').textContent = dateString;
    document.getElementById('local-time').textContent = timeString;

    // 计算并设置时区偏移量（分钟）
    const timezoneOffset = localTime.getTimezoneOffset();
    document.getElementById('timezoneOffset').value = timezoneOffset;

    // 转换为 UTC 时间
    const utcTime = new Date(localTime.getTime() + (timezoneOffset * 60000));

    // 打印 UTC 时间用于调试
    console.log("UTC Time: ", utcTime.toISOString());

    // 设置 UTC 时间到隐藏字段
    document.getElementById('utc-time').value = utcTime.toISOString();

    // 获取用户位置
    fetch('https://ipinfo.io/json?token=7272cb1896447f')
        .then(response => response.json())
        .then(data => {
            const location = `${data.city}, ${data.region}, ${data.country}`;
            document.getElementById('display-location').textContent = location;
            document.getElementById('location').value = location; // 将位置设置到隐藏字段
        })
        .catch(error => {
            console.error('Error fetching location data:', error);
            document.getElementById('display-location').textContent = "Location not available";
        });
});

function togglePaymentOption(selectedOption) {
    const options = document.querySelectorAll('.payment-details');
    options.forEach(option => {
      if (option.id === selectedOption) {
        option.style.display = option.style.display === 'block' ? 'none' : 'block';
      } else {
        option.style.display = 'none';
      }
    });
}

document.getElementById('bank_transfer_proof').addEventListener('change', function(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var output = document.getElementById('proof_preview');
      output.src = reader.result;
      output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
});

document.getElementById('checkout-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const messages = {
      'en': 'Order submitted, please wait for activation.',
      'zh': '己提交訂單，請等候開通',
      // Add other languages as needed
    };

    const userLang = navigator.language || navigator.userLanguage;
    const message = messages[userLang] || messages['en'];
    
    alert(message);

    // Simulate form submission for demo purposes
    setTimeout(() => {
      this.submit();
    }, 1000);
});

</script>
@endsection



