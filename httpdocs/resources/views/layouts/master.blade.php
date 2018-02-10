<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title> Buddhijeevi:  @yield('title') </title>
        
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/metisMenu.min.css') }}" />        
        <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/dropkick.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/colorbox.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/jquery-te-1.4.0.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}" />
        <link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
        <script src="{{ asset('assets/js/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
        @include('layouts/header')
        <div class="container-fluid {{ !empty($container_class) ? $container_class : 'body-section' }}">
            <div class="row">
                @yield('content')
            </div>
        </div>
        @include('layouts/footer')
        <script src="{{ asset('assets/js/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('assets/js/site.js') }}"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.colorbox.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dropkick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery-te-1.4.0.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/date.js') }}"></script>
        
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/metisMenu.min.js') }}"></script>
        @yield('page_script')
    </body>
</html>