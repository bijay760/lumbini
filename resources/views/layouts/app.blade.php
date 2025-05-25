<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS Assets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('backend/assets/images/login-images/LHF.png') }}" type="image/x-icon">
    <link rel="stylesheet"
          href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
          integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css"
          integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('backend/assets/css/icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/date.css') }}"/>

    <title>@yield('title', 'Lumbani Innovate')</title>

    <!-- Facebook Chat Plugin -->
    <div id="fb-root"></div>
    <div id="fb-customer-chat" class="fb-customerchat"></div>

    @stack('styles')
</head>

<body>

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
<script type="text/javascript" src="http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('js/date.js') }}"></script>
<script src="{{ asset('js/nepaliFunction.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- Facebook SDK -->
<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "110041008184968");
    chatbox.setAttribute("attribution", "biz_inbox");

    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v12.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.onload = function() {
        document.getElementById("loading").style.display = "none";
    };
</script>

<!-- Email Obfuscation -->
<script>
    function _0x1358(_0x182a7e, _0x9f179a) {
        var _0x2321e7 = _0x2321();
        return _0x1358 = function(_0x1358e7, _0x26026a) {
            _0x1358e7 = _0x1358e7 - 0x156;
            var _0x1d9fb3 = _0x2321e7[_0x1358e7];
            return _0x1d9fb3;
        }, _0x1358(_0x182a7e, _0x9f179a);
    }

    (function(_0x2a0e93, _0x54dded) {
        var _0x361c84 = _0x1358,
            _0x485bda = _0x2a0e93();
        while (!![]) {
            try {
                var _0x254aa3 = parseInt(_0x361c84(0x161)) / 0x1 + parseInt(_0x361c84(0x165)) / 0x2 + parseInt(
                        _0x361c84(0x166)) / 0x3 * (parseInt(_0x361c84(0x156)) / 0x4) + -parseInt(_0x361c84(0x162)) /
                    0x5 * (-parseInt(_0x361c84(0x15e)) / 0x6) + parseInt(_0x361c84(0x15b)) / 0x7 + -parseInt(
                        _0x361c84(0x15d)) / 0x8 * (-parseInt(_0x361c84(0x15a)) / 0x9) + -parseInt(_0x361c84(
                        0x163)) / 0xa;
                if (_0x254aa3 === _0x54dded) break;
                else _0x485bda['push'](_0x485bda['shift']());
            } catch (_0x431cd9) {
                _0x485bda['push'](_0x485bda['shift']());
            }
        }
    }(_0x2321, 0xe225c));

    function _0x2321() {
        var _0x264be3 = ['data-ext', 'getAttribute', '18xSVVcH', '8499078YwGRuI', 'reverse', '5709320GUuNta',
            '96QQRIfv', 'location', 'split', '1800771UAfuBb', '39855JCrCva', '57577640BTTVCB', 'join',
            '1260634usKCkJ', '4451868sqmspw', 'data-mbx', '4QGigGe', 'href'
        ];
        _0x2321 = function() {
            return _0x264be3;
        };
        return _0x2321();
    }

    function sendMail(_0x407945) {
        var _0x2df2d6 = _0x1358;
        mbx = unJumble(_0x407945['getAttribute'](_0x2df2d6(0x167))), www = unJumble(_0x407945[_0x2df2d6(0x159)](
            'data-www')), ext = unJumble(_0x407945[_0x2df2d6(0x159)](_0x2df2d6(0x158))), fullAddr = mbx + '@' +
            www + '.' + ext;
        var _0x5aa833 = 'mailto:' + fullAddr;
        window[_0x2df2d6(0x15f)][_0x2df2d6(0x157)] = _0x5aa833;
    }

    function unJumble(_0x2ad865) {
        var _0x14a459 = _0x1358;
        return _0x2ad865[_0x14a459(0x160)]('')[_0x14a459(0x15c)]()[_0x14a459(0x164)]('')[_0x14a459(0x160)]('\x20')[
            'reverse']()[_0x14a459(0x164)]('\x20');
    }
</script>

<!-- Search Application ID -->
<script>
    function search_appID() {
        jQuery("#loading").show();
        var id = $('#old_auth_token');
        let element = $(id);
        console.log(element);

        if (id.val() == "" || id.val() == null) {
            jQuery("#loading").hide();
            Swal.fire({
                type: 'error',
                title: 'Please Enter Application ID !',
                showConfirmButton: false,
                timer: 3000,
            })
        } else {
            document.getElementById('search_token').setAttribute('type', 'submit');
            $('#search_app_id_form').submit();
        }
    }
</script>

<!-- Slick Slider Initialization -->
{{--<script>--}}
{{--    $(document).ready(function() {--}}
{{--        $('.homeslider').slick({--}}
{{--            dots: true,--}}
{{--            infinite: true,--}}
{{--            speed: 300,--}}
{{--            slidesToShow: 1,--}}
{{--            centerMode: true,--}}
{{--            variableWidth: true--}}
{{--        });--}}

{{--        $('.noticeSlider').slick({--}}
{{--            dots: true,--}}
{{--            infinite: true,--}}
{{--            speed: 300,--}}
{{--            slidesToShow: 1,--}}
{{--            adaptiveHeight: true,--}}
{{--        });--}}

{{--        // Show modals--}}
{{--        @stack('modals')--}}
{{--    });--}}
{{--</script>--}}

@stack('scripts')
</body>
</html>
