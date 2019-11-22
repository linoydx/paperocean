<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Login</title>
<meta name="description" content="">
<meta name="keywords" content="">
<link href="{{ asset('/public/css/admin/commen.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/public/css/admin/login.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="main">
		<div class="img">
			<img src="{{ asset('/public/img/admin/login.png')}}" alt="image">
		</div>
		<div class="list">
			<div class="list-top">
				<div style="color:#4680ff;"><b>P&nbsp;A&nbsp;P&nbsp;E&nbsp;R&nbsp;O&nbsp;C&nbsp;E&nbsp;A&nbsp;N</b></div>
				<div style="font-size: 18px"><b>Welcome Back!</b></div>
				<div>
					@if(session('msg'))
					<p>{{session('msg')}}</p>
					@endif
				</div>
			</div>
			<div class="list-main">
				<form action="{{ url('admin/login') }}" method="post" name="login">
					{{csrf_field()}}
    			<ul>
    				<li id="item">用户名&nbsp;&nbsp;<input class="ipt" type="text" name="username"></li>
    				<li id="item">密&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;<input class="ipt" type="password" name="password"></li>
    				<li id="item">验证码&nbsp;&nbsp;<input class="ipt-sm" type="text" name="verify"><div class="verify"><img src="{{ url('admin/verify') }}" alt="verify" onclick="this.src='{{ url('admin/verify') }}?'+Math.random()"></div></li>
    				<li id="item btn"><button type="submit" class="btn">登&nbsp;&nbsp;录</button></li>
   				</ul>
   			</form>
			</div>
   		</div>
   	</div>
</body>
</html>