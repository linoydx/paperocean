@extends('layouts.index.home')
@section('content')
@include('layouts.index.top')
@include('layouts.index.usertop')

@if(!empty($data))
@include('layouts.index.userleft')
<style>
	#ue-box {
		position: absolute;
		top: 130px;
		left: 320px;
		padding: 40px;
		margin-bottom: 40px;
		width: 800px;
		height: 400px;
		border: 1px solid #c4d5e0;
	}
</style>
<div id="ue-box">
			@if (session('msg'))
			<span>{{session('msg')}}</span>
			@endif
			<form action="{{ url('user/'.$data->id) }}" method="post">
			{{ csrf_field() }}
				<ul id="user-edit-list">
					@if($data)
					<li>头像<img src="" alt=""></li>
					<li>嗨，{{ $data->username }}，填写真实资料，有助于好友找到你哦！</li>
					<li>昵称<input type="text" name="nickname" value="{{ $data->nickname }}"></li>
					<li>电话<input type="text" name="telephone" value=""></li>
					<li><input type="submit" value="保 存"></li>
					@endif
				</ul>
			</form>
		</div>
@endif
@endsection