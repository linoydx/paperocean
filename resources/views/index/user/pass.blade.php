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
	<form action="" method="post">
			{{ csrf_field() }}
		<ul id="user-edit-list">		
			<li><input type="password" name="password_old"></li>
			<li><input type="password" name="password"></li>
			<li><input type="password" name="password_confirmation"></li>
			<li><input type="submit" value="保 存"></li>
		</ul>
	</form>
</div>
@endif
@endsection