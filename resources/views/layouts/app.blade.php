<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Primary Meta Tags -->
        <title>@yield('title', $seoData['title'] ?? 'Lumbani Innovate - Complete Real Estate Solutions')</title>
        <meta name="title" content="@yield('title', $seoData['title'] ?? 'Lumbani Innovate - Complete Real Estate Solutions')">
        <meta name="description" content="@yield('meta_description', $seoData['description'] ?? 'Complete real estate solution in Nepal. Property listings, land deals, home buying/selling, and innovative property management services.')">
        <meta name="keywords" content="@yield('meta_keywords', $seoData['keywords'] ?? 'real estate Nepal, property Kathmandu, buy land Nepal, sell house Nepal, property management, real estate solutions, Lumbani Innovate')">

        <!-- SEO Meta Tags -->
        <meta name="author" content="Lumbani Innovate">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
        <meta name="googlebot" content="index, follow">
        <meta name="revisit-after" content="7 days">
        <meta name="language" content="English">
        <meta name="geo.region" content="NP">
        <meta name="geo.placename" content="Kathmandu, Nepal">
        <meta name="geo.position" content="27.7172;85.3240">
        <meta name="ICBM" content="27.7172, 85.3240">

        <!-- Canonical URL -->
        <link rel="canonical" href="{{ $seoData['canonical'] ?? url()->current() }}">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="@yield('og_type', $seoData['og_type'] ?? 'website')">
        <meta property="og:url" content="{{ $seoData['canonical'] ?? url()->current() }}">
        <meta property="og:title" content="@hasSection('og_title')@yield('og_title')@else{{ $seoData['og_title'] ?? $seoData['title'] ?? 'Lumbani Innovate - Complete Real Estate Solutions in Nepal' }}@endif">
        <meta property="og:description" content="@hasSection('og_description')@yield('og_description')@else{{ $seoData['og_description'] ?? $seoData['description'] ?? 'Your trusted partner for all real estate needs in Nepal. Find, buy, sell, and manage properties with our innovative solutions.' }}@endif">
        <meta property="og:image" content="@yield('og_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:site_name" content="Lumbani Innovate">
        <meta property="og:locale" content="en_US">

        <!-- Twitter -->
        <meta property="twitter:card" content="@yield('twitter_card', 'summary_large_image')">
        <meta property="twitter:url" content="{{ $seoData['canonical'] ?? url()->current() }}">
        <meta property="twitter:title" content="@hasSection('twitter_title')@yield('twitter_title')@else{{ $seoData['og_title'] ?? $seoData['title'] ?? 'Lumbani Innovate - Complete Real Estate Solutions in Nepal' }}@endif">
        <meta property="twitter:description" content="@hasSection('twitter_description')@yield('twitter_description')@else{{ $seoData['og_description'] ?? $seoData['description'] ?? 'Your trusted partner for all real estate needs in Nepal. Find, buy, sell, and manage properties with our innovative solutions.' }}@endif">
        <meta property="twitter:image" content="@yield('twitter_image', 'https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png')">
        <meta name="twitter:site" content="@LumbaniInnovate">
        <meta name="twitter:creator" content="@LumbaniInnovate">

        <!-- Favicons and Icons -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/images/login-images/LHF.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/assets/images/login-images/LHF.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}">

        <!-- PWA Meta Tags -->
        <meta name="theme-color" content="#20254D">
        <meta name="msapplication-navbutton-color" content="#20254D">
        <meta name="apple-mobile-web-app-status-bar-style" content="#20254D">
        <meta name="msapplication-TileColor" content="#20254D">
        <meta name="msapplication-TileImage" content="{{ asset('backend/assets/images/login-images/logo%20(3).png') }}">

        <!-- Web App Manifest -->
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
        <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

        <!-- CSS Assets -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <link rel="stylesheet"
                href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
                integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
                integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('backend/assets/css/icons.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/form.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/date.css') }}" />

        @stack('styles')

        <!-- Structured Data -->
        <script type="application/ld+json">
                {
                        "@context": "https://schema.org",
                        "@type": "RealEstateAgent",
                        "name": "Lumbani Innovate Pvt. Ltd.",
                        "image": "https://lumbiniinnovate.com.np/backend/assets/images/login-images/logo%20(3).png",
                        "description": "Complete real estate solution in Nepal. Property listings, land deals, home buying/selling, and innovative property management services.",
                        "url": "https://lumbiniinnovate.com.np",
                        "telephone": "+977-9851234567",
                        "address": {
                                "@type": "PostalAddress",
                                "addressCountry": "Nepal",
                                "addressLocality": "Kathmandu",
                                "addressRegion": "Bagmati Province"
                        },
                        "areaServed": {
                                "@type": "Country",
                                "name": "Nepal"
                        },
                        "serviceType": ["Real Estate", "Property Management", "Land Registration", "Property Consultation"],
                        "sameAs": [
                                "https://www.facebook.com/lumbaniinnovate",
                                "https://www.twitter.com/lumbaniinnovate"
                        ]
                }
        </script>

        @stack('structured_data')
</head>

<body>
        <!-- Facebook Chat Plugin -->
        <div id="fb-root"></div>
        <div id="fb-customer-chat" class="fb-customerchat"></div>

        @include('partials.top-bar')

        @include('partials.navbar')

        <main>
                @yield('content')
        </main>

        @include('partials.footer')

        <!-- Scripts -->
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
                integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"
                integrity="sha512-k2GFCTbp9rQU412BStrcD/rlwv1PYec9SNrkbQlo6RZCf75l6KcC3UwDY8H5n5hl4v77IDtIPwOk9Dqjs/mMBQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
                integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/date.js') }}"></script>
        <script src="{{ asset('js/nepaliFunction.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        @stack('scripts')
</body>

</html>