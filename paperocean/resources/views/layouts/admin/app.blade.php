<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>paperocean</title>
<link href="{{ asset('/public/css/admin/commen.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/css/admin/app.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/css/admin/sidebar.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/css/admin/main.css') }}" rel="stylesheet" type="text/css">
<script src="{{ asset('/bootstrap/jquery/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('/resources/org/layer/layer.js') }}"></script>
<script src="{{ asset('/public/js/admin/common.js') }}"></script>
</head>
<body>
    
     @yield('content')

  
</body>
</html>