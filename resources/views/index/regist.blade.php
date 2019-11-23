@extends('layouts.index.home')

@section('content')
<style>
	#regist-box {
		width: 700px;
		height: 500px;
		margin: 100px auto;
	}
	#regist-list {

	}
	.regist-list-item {
		display: block;
		margin: 20px 10px;
		font-size: 16px;
		font-weight: 1000;
	}
	.input-box {
		width: 240px;
		height: 20px;
	}
	.button {
		width: 80px;
		height: 20px;
		margin: 0 22px;
	}
</style>
@include('layouts.index.top')
<div id="main">
	<div id="regist-box">
		@if ($errors->any())
    		<div class="alert alert-danger" style="color: red;">
       			 <ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
		@endif
		<form  action="{{ url('regist') }}" method="post">
			{{csrf_field()}}
			<ul id="regist-list">
				<li class="regist-list-item">
					<label for="username">用&nbsp;&nbsp;户&nbsp;&nbsp;名：</label><input class="input-box" id="username" type="text" name="username"><span style="font-size: 14px"></span>
				</li>
				<li class="regist-list-item">
					<label for="password">&nbsp;密&nbsp;&nbsp;&nbsp;&nbsp;码&nbsp;&nbsp;&nbsp;：</label><input class="input-box" id="password" type="password" name="password" placeholder="由字母和数字组成6-20位">
				</li>
				<li class="regist-list-item">
					<label for="cpassword">确认密码：</label><input class="input-box" id="cpassword" type="password" name="password_confirmation"><img src="" alt="" width='20px' height='20px'>
				</li>
				<li class="regist-list-item">
					<label for="telephone">&nbsp;电&nbsp;&nbsp;&nbsp;&nbsp;话&nbsp;&nbsp;：</label><input class="input-box" id="telephone" type="text" name="telephone">
				</li>
				<li class="regist-list-item">
					<input type="reset" class="button" value=" 重置 ">
					<input type="submit" class="button" value="注册">
				</li>
			</ul>	
		</form>
	</div>
</div>
<script>
	$('#username').focusout(function(event) {
		var username = $('#username').val();
		if (username) {
			$.post("{{ url('/user/checkuser') }}", {'username': username,'_token':"{{ csrf_token() }}"}, function(data) {
				if (data == 1) {
					$('#username').next('span').css('color', 'red').text('用户名已存在！！');
				} else {
					$('#username').next('span').css('color', 'green').text('用户名可用！！');
				}
			});
		} else {
			alert('请输入用户名！');
		}
	});
	$('#cpassword').keyup(function(event) {
		var password = $('#password').val();
		var cpassword = $('#cpassword').val();
		if (cpassword == password) {
			$('#cpassword').next('img').attr('src', "{{ asset('/public/img/index/ture-icon.jpg') }}");
		} else {
			$('#cpassword').next('img').attr('src', "{{ asset('/public/img/index/false-icon.jpg') }}");
		}
	});
</script>

@endsection