<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">        
        <title>Buddhijeevi:  @yield('title') </title>
        
        <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('resources/assets/css/custom.css') }}">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <link rel="stylesheet" href="{{ asset('resources/assets/css/normalize.css') }}" />
        <!-- <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.css') }}" />-->
        <link rel="stylesheet" href="{{ asset('resources/assets/css/jquery.mCustomScrollbar.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/css/dropkick.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/css/colorbox.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/css/jquery-te-1.4.0.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/css/main.css') }}" />
        <link rel="stylesheet" href="{{ asset('resources/assets/css/master.css') }}" />	
        <link rel="stylesheet" href="{{ asset('resources/assets/css/site.css') }}" />	
        <script src="{{ asset('resources/assets/js/modernizr-2.8.3.min.js') }}"></script>        
    </head>
    
    <body class="{{Request::route()->getName()}}">
        <a name="top"  style="display:none;">&nbsp;</a>
        @if(URL::to('/') == URL::current())			
            @include('layouts/header')
            <div id="wrapper" class="homeTemp">
        @else
            @if(URL::to('/account/login') != URL::current())	
            @include('layouts/header')
            @endif
            <div id="wrapper" class="subTemp">
        @endif

        @yield('content')
            </div>
        @include('layouts/footer')
        <script src="{{ asset('resources/assets/js/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('resources/assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('resources/assets/js/site.js') }}"></script>
        <script src="{{ asset('resources/assets/js/plugins.js') }}"></script>
        <script src="{{ asset('resources/assets/js/jquery.colorbox.js') }}"></script>
        <script src="{{ asset('resources/assets/js/bootstrap.js') }}"></script>
        <script src="{{ asset('resources/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script src="{{ asset('resources/assets/js/jquery.dropkick.js') }}"></script>
                        <script src="{{ asset('resources/assets/js/jquery-te-1.4.0.js') }}"></script>
        <script src="{{ asset('resources/assets/js/main.js') }}"></script>
        <script src="{{ asset('resources/assets/js/date.js') }}"></script>
        @yield('page_script')
    </body>
</html>
