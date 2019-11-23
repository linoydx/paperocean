
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
			<th>分类ID</th>
			<th>分类名称</th>
			<th>&nbsp;操&nbsp;&nbsp;&nbsp;&nbsp;作&nbsp;</th>
		</tr>
		@if($data)
			@foreach ($data as $cate)
				<tr>
					<td>{{ $cate['id'] }}</td>
					<td>{{ str_repeat('|-',$cate['level']+1) }}{{ $cate['cate_name'] }}</td>
					<td><a href="{{ url('cate/'.$cate['id'].'/edit') }}" target="main">修改</a>&nbsp;&nbsp;<a href="javascript:;"  onclick="delCate('{{ $cate['id'] }}')" target="main">删除</a></td>
				</tr>
			@endforeach
		@endif
	</table>
</div>
<script>
	//删除cate
	function delCate(id) {
		layer.confirm('您确定要删除这个分类吗？', {
  		btn: ['确定','取消'] //按钮
		}, function(){
  		$.post("{{url('cate/')}}/"+id, {'_method':'delete','_token':"{{ csrf_token() }}"} , function(data) {
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