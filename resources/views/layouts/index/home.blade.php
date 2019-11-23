<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link href="{{ asset('/public/css/Admin/commen.css') }}" rel="stylesheet">
        <link href="{{ asset('/public/css/Index/main.css') }}" rel="stylesheet">
        <script src="{{ asset('/bootstrap/jquery/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('/bootstrap/jquery/jquery.cookie.js') }}"></script>
        <script src="{{ asset('/public/js/Index/commen.js') }}"></script>
        <title>PaperOcean</title>
    </head>
    <body>
 
    @yield('content')
    
    
    </body>
</html>
