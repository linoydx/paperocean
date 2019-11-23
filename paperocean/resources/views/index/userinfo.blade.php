@extends('layouts.index.home')
@section('content')
@include('layouts.index.top')
@include('layouts.index.usertop')
@include('layouts.index.userleft')
<style>
	#ui-info {
		position: absolute;
		top: 130px;
		left: 320px;
		padding: 40px;
		margin-bottom: 40px;
		width: 800px;
		height: 400px;
		border: 1px solid #c4d5e0; 
	}
	#ui-title {
		padding: 12px 0 0 20px;
    	line-height: 30px;
    	font-weight: 700;
    	border-bottom: 1px solid #D5E5F4;
    	margin-top: -1px;
    	zoom: 1;
    	position: relative;
		color: #404040;
	}
	#ui-info-list {
		margin-top: 20px;
		padding-left: 16px;
    	line-height: 22px;
    	list-style: none;
    	color: #000;
	}
	#ui-info-list li{
		margin-top: 10px;
	}
</style>
<div id="ui-info">
	<div id="ui-title">您的基础信息</div>
		<ul id="ui-info-list">
			<li>会员名{{ $data->username }}</li>
			<li>绑定邮箱</li>
			<li>绑定手机 {{ $data->telephone }}</li>
		</ul>
	</div>	
</div>
@endsection