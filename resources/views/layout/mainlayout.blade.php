<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('layout.partials.head')

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="專業線上英文教學平台，提供一對一線上英文課程。與外籍教師進行 Online 一對一教學，彈性且高效的學習方式。">
  <meta name="keywords" content="線上英文,線上課程,線上一對一,Online 一對一,英文教學,外籍教師">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="EnggleTalk - 專業線上英文教學平台">
  <meta property="og:description" content="專業線上英文教學平台，提供一對一線上英文課程。與外籍教師進行 Online 一對一教學，彈性且高效的學習方式。">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url('/') }}">
  
  <link rel="preload" href="/assets/plugins/fontawesome/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
    crossorigin>
  <link rel="preload" href="/assets/plugins/fontawesome/webfonts/fa-regular-400.woff2" as="font" type="font/woff2"
    crossorigin>

  @vite(['resources/js/app.js'])

  @php
use Spatie\SchemaOrg\Schema;

$organization = Schema::organization()
    ->name('EnggleTalk')
    ->url('https://enggle.com.tw')
    ->description('專業線上英文教學平台，提供一對一線上英文課程')
    ->sameAs(['https://facebook.com/your-company', 'https://twitter.com/your-company']);

$website = Schema::website()
    ->name('EnggleTalk')
    ->url('https://enggle.com.tw')
    ->description('專業線上英文教學平台')
    ->potentialAction(
        Schema::searchAction()
            ->target('https://enggle.com.tw/search?q={search_term_string}')
            ->setProperty('query-input', 'required name=search_term_string')
    );

$course = Schema::course()
    ->name('線上一對一英文課程')
    ->description('專業外籍教師一對一線上英文教學，提供彈性且高效的學習方式')
    ->provider($organization)
    ->educationalCredentialAwarded('英語能力證書')
    ->hasCourseInstance(
        Schema::courseInstance()
            ->courseMode('online')
            ->educationalCredentialAwarded('英語能力證書')
    );

$educationalOrganization = Schema::educationalOrganization()
    ->name('EnggleTalk 線上英文教學平台')
    ->description('提供專業的線上英文教學服務')
    ->url('https://enggle.com.tw')
    ->address(
        Schema::postalAddress()
            ->addressCountry('TW')
    )
    ->makesOffer(
        Schema::offer()
            ->itemOffered($course)
    );

echo $organization->toScript();
echo $website->toScript();
echo $course->toScript();
echo $educationalOrganization->toScript();
@endphp

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-978862095">
</script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-978862095');
</script>
<!-- Event snippet for 12312 conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-978862095/U-6TCNmT8wcQj4Dh0gM',
      'value': 1.0,
      'currency': 'TWD'
  });
</script>

<!-- Event snippet for 所有訪客 conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-978862095/Kka-CPmS_AcQj4Dh0gM',
      'value': 1.0,
      'currency': 'TWD'
  });
</script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Noto Sans TC', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
        }
        .grecaptcha-badge {
            visibility: hidden !important;
            opacity: 0.1 !important;
            bottom: 10px !important;
        }
    </style>

    @yield('styles')
</head>
@include('layout.partials._logout_form')


@if (session('alert'))
    <div class="alert alert-warning">
        {{ session('alert') }}
    </div>
@endif
@if (Route::is(['map-grid']))

  <body class="map-page">
@endif
@if (Route::is(['mentor-register', 'login', 'register', 'mentee-register']))

  <body class="account-page">
@endif
@if (Route::is(['chat-mentee', 'chat']))

  <body class="chat-page">
@endif




@if (Route::is(['voice-call', 'video-call']))

  <body class="call-page">
@endif
@if (!Route::is(['login', 'register', 'forgot-password']))
  @include('layout.partials.header')
@endif
@yield('content')



@if (!Route::is(['chat', 'chat-mentee', 'voice-call', 'video-call', 'login', 'register', 'forgot-password']))
  @include('layout.partials.footer')
@endif
@include('layout.partials.footer-scripts')
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/shared-translations.js') }}"></script>
<script src="{{ asset('assets/js/logout.js?v=' . time()) }}"></script>

@yield('scripts')
</body>

</html>
