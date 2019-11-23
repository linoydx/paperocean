@extends('layouts.index.home')
@section('content')
@include('layouts.index.top')
<link rel="stylesheet" href="{{ asset('/public/css/Index/usershow.css') }}">
@include('layouts.index.usertop')
	<div id="ub-main">
		<div id="ubm-left">
			<h3>全部功能</h3>
			<ul>
				<li><a href="">我的购物车</a></li>
				<li><a href="{{ url('order') }}">已买到的宝贝</a></li>
				<li><a href="">购买过的店铺</a></li>
				<li><a href="">我的发票</a></li>
				<li><a href="">我的收藏</a></li>
				<li><a href="">我的积分</a></li>
				<li><a href="">评价管理</a></li>
				<li><a href="">退款维权</a></li>
			</ul>
		</div>
		<div id="ubm-user">
			@if(!empty($data))
			<div id="ubm-user-detials">
				@if(!empty($data['user']))
				<div id="ubm-user-pic"><img src="" alt="头像" width="40px" height="40px"></div>
				<div id="ubm-user-msg">
					
					<span></span>（<span>{{$data['user']}}</span>）
					
				</div>
				<div id="ubm-user-address"><a href="">我的收获地址</a></div>
				@endif
			</div>
			<div id="ubm-order">
				<ul id="ubmo-list">
					@if(!empty($data['num']))
					<li><a href="">待付款（{{ $data['num']['nopayment'] }}）</a></li>
					<li><a href="">待发货（{{ $data['num']['unshipped'] }}）</a></li>
					<li><a href="">待收货（{{ $data['num']['posting'] }}）</a></li>
					<li><a href="">待评价（{{ $data['num']['nocomment'] }}）</a></li>
					<li style="border:none;"><a href="">退款</a></li>
					@endif
				</ul>
			</div>
			<div id="ubm-user-postmsg">
				<div id="ubmu-title"><p>我的物流</p></div>
				<div id="ubmu-content">物流信息</div>
			</div>
			<div id="ubm-user-like"></div>
			@endif
		</div>
		<div id="ubm-right">
			<div id="ubm-right-data">
				<div id="ubm-data-title"></div>
				<div id="ubm-data-item"></div>
			</div>
			<div id="ubm-right-tools">
				<img src="{{ asset('/public/img/index/tools.jpg') }}" alt="" width="300px" height="268px">
			</div>
		</div>
	</div>


@endsection