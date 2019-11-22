
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
			<th>图书名称</th>
			<th>所属分类</th>
			<th>库存数量</th>
			<th>指导价格</th>
			<th>线上价格</th>
			<th>&nbsp;操&nbsp;&nbsp;&nbsp;&nbsp;作&nbsp;</th>
		</tr>
		@if($data)
			@foreach ($data as $v)
				<tr>
					<td>{{ $v->book_name }}</td>
					<td>{{ $v->cate_name }}</td>
					<td>{{ $v->book_number }}</td>
					<td>{{ $v->guide_price }}</td>
					<td>{{ $v->shop_price }}</td>
					<td><a href="{{ url('book/'.$v['id']) }}" target="main">详细</a>&nbsp;&nbsp;<a href="javascript:;"  onclick="delBook('{{$v->id}}')" target="main">删除</a></td>
				</tr>
			@endforeach
		@endif
	</table>
	<ul id="page-list">
		{{ $data->links() }}
	</ul>
</div>
<script>
	//删除book
	function delBook(id) {
		layer.confirm('您确定要删除这个图书吗？', {
  		btn: ['确定','取消'] //按钮
		}, function(){
	  		$.post("{{url('book/')}}/"+id, {'_method':'delete','_token':"{{ csrf_token() }}"} , function(data) {
	  			if (data.status == 0) {
	  				location.href = location.href;
	  				layer.msg(data.msg, {icon:6});
	  			} else {
	  				layer.msg(data.msg, {icon:5});
	  			}
	  		});
		});
	}	
</script>

@endsection