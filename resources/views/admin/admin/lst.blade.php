
@extends('layouts.admin.app')

@section('content')

<div class="lst">
	<div>
		@if(session('msg'))
			<p>{{session('msg')}}</p>
		@endif
	</div>
	<table class="lst-table">
		<tr>
			<th>&nbsp;姓&nbsp;&nbsp;&nbsp;&nbsp;名&nbsp;</th>
			<th>&nbsp;工&nbsp;&nbsp;&nbsp;&nbsp;号&nbsp;</th>
			<th>联系方式</th>
			<th>管理角色</th>
			<th>&nbsp;操&nbsp;&nbsp;&nbsp;&nbsp;作&nbsp;</th>
		</tr>
		@foreach ($data as $v)
		
		<tr>
			<!-- <input type="hidden" name="admin_id" value="{{ $v->id }}"> -->
			<td>{{ $v->username }}</td>
			<td>{{ $v->jobnumber }}</td>
			<td>{{ $v->telephone }}</td>
			<td>@switch($v->role_id)
    			@case(1)
        			超级管理员
        		@break

    			@case(2)
        			图书管理员
        		@break

				@case(3)
        			论坛管理员
        		@break
    			@default
				@endswitch
			</td>
			<td><a href="{{ url('admin/'.$v->id.'/edit') }}" target="main">修改</a>&nbsp;&nbsp;<a href="javascript:;"  onclick="delAdmin('{{$v->id}}')" target="main">删除</a></td>
		</tr>
		@endforeach
	</table>
</div>
<script>
	//删除admin
	function delAdmin(id) {
		layer.confirm('您确定要删除这个管理员吗？', {
  		btn: ['确定','取消'] //按钮
		}, function(){
  		$.post("{{url('admin/')}}/"+id, {'_method':'delete','_token':"{{ csrf_token() }}"} , function(data) {
  			if (data.status == 0) {
  				location.href = location.href;
  				layer.msg(data.msg, {icon:6});
  			} else {
  				layer.msg(data.msg, {icon:5});
  			}
  		});
		}, function(){
  		
  		});

	}
</script>

@endsection