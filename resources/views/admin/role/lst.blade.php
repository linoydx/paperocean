
@extends('layouts.admin.app')

@section('content')

<div class="lst">
	<div>
		@if(session('msg'))
			<p>{{ session('msg') }}</p>
		@endif
	</div>
	<table class="lst-table">
		<tr>
			<th>角色名称</th>
			<th>角色描述</th>
			<th>&nbsp;操&nbsp;&nbsp;&nbsp;&nbsp;作&nbsp;</th>
		</tr>
		@if($data)
			@foreach ($data as $role)
				<tr>
					<td>{{ $role->role_name }}</td>
					<td>{{ $role->role_description }}</td>
					<td><a href="{{ url('role/'.$role->id.'/edit') }}" target="main">修改</a>&nbsp;&nbsp;<a href="javascript:;"  onclick="delRole('{{ $role->id }}')" target="main">删除</a></td>
				</tr>
			@endforeach
		@endif
	</table>
</div>
<script>
	//删除cate
	function delRole(id) {
		layer.confirm('您确定要删除这个角色吗？', {
  		btn: ['确定','取消'] //按钮
		}, function(){
  		$.post("{{url('role/')}}/"+id, {'_method':'delete','_token':"{{ csrf_token() }}"} , function(data) {
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