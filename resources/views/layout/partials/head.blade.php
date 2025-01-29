<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ __('meta_title') }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ __('meta_description') }}">
    <meta name="robots" content="index, follow">
    @php
    use Spatie\SchemaOrg\Schema;
    
    $organization = Schema::organization()
        ->name('EnggleTalk')
        ->url('https://enggle.com.tw')
        ->sameAs('https://facebook.com/your-company')
        ->sameAs('https://twitter.com/your-company');
    
    echo $organization->toScript();
    @endphp
    
    <!-- Favicons -->
    <link type="image/x-icon" href="/assets/img/favicon.png" rel="icon">

    <!-- Open Graph Meta Tags (for Facebook, Instagram, LinkedIn) -->
    <meta property="og:title" content="{{ __('og_title') }}">
    <meta property="og:description" content="{{ __('og_description') }}">
    <meta property="og:image" content="/assets/img/og-image.png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('twitter_title') }}">
    <meta name="twitter:description" content="{{ __('twitter_description') }}">
    <meta name="twitter:image" content="/assets/img/twitter-card-image.png">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Alternate Language Links for SEO zh-TW -->
    <link rel="alternate" href="{{ url('/?lang=zh_TW') }}" hreflang="zh_TW">
    <link rel="alternate" href="{{ url('/?lang=en') }}" hreflang="en">
    <link rel="alternate" href="{{ url('/?lang=zh-CN') }}" hreflang="zh-CN">
    <link rel="alternate" href="{{ url('/?lang=ja') }}" hreflang="ja">
    <link rel="alternate" href="{{ url('/?lang=ko') }}" hreflang="ko">
    <link rel="alternate" href="{{ url('/?lang=vi') }}" hreflang="vi">

    <!-- Structured Data (Schema Markup for Organization and Website) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "EnggleTalk",
      "url": "https://enggletalk.com.tw",
      "logo": "https://enggletalk.com.tw/assets/img/logo.png",
      "sameAs": [
        "https://www.facebook.com/enggletalk",
        "https://www.instagram.com/enggletalk"
      ],
      "description": "{{ __('meta_description') }}"
    }
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "EnggleTalk",
      "url": "https://enggletalk.com.tw",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://enggletalk.com.tw/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="/assets/plugins/fontawesome/css/all.min.css">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="/assets/plugins/slick/slick.css">
    <link rel="stylesheet" href="/assets/plugins/slick/slick-theme.css">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="/assets/css/feathericon.min.css">
</head>
