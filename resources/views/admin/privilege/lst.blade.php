
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
			<th>权限名称</th>
			<th>权限路由</th>
			<th>权限描述</th>
			<th>&nbsp;操&nbsp;&nbsp;&nbsp;&nbsp;作&nbsp;</th>
		</tr>
		@if($data)
			@foreach ($data as $pri)
				<tr>
					<td>{{ $pri->pri_name }}</td>
					<td>{{ $pri->pri_route }}</td>
					<td>{{ $pri->pri_description }}</td>
					<td><a href="{{ url('pri/'.$pri->id.'/edit') }}" target="main">修改</a>&nbsp;&nbsp;<a href="javascript:;"  onclick="delPri('{{ $pri->id }}')" target="main">删除</a></td>
				</tr>
			@endforeach
		@endif
	</table>
</div>
<script>
	//删除cate
	function delPri(id) {
		layer.confirm('您确定要删除这个权限吗？', {
  		btn: ['确定','取消'] //按钮
		}, function(){
  		$.post("{{url('pri/')}}/"+id, {'_method':'delete','_token':"{{ csrf_token() }}"} , function(data) {
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