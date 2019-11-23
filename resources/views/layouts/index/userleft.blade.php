<style>
	#ui-menu {
		position: relative;
		top: 40px;
		left: 120px;
		width: 160px;
		height: auto;
		text-align: center;
	}
	#ui-img {
		margin:2px 39px; 
		width: 80px;
		height: 80px;
		border: 1px solid #c4d5e0; 
	}
	#uim-list {
		margin-top: 20px;
		padding: 0;
		list-style: none;
		height: 28px;
		line-height: 28px;
		color: #000;
		font-size: 14px;
		cursor: pointer;
	}
	#uim-list a{
		color: #000;
	}
</style>
<div id="ui-menu">
	<div id="ui-img"></div>	
	<ul id="uim-list">
		<li class="uim-list-item"><a href="{{ url('user/'.$data->id.'/edit') }}">个人资料</a></li>
		<li class="uim-list-item"><a href="{{ url('user/'.$data->id.'/pass') }}">修改密码</a></li>
		<li class="uim-list-item"><a href="{{ url('user/'.$data->id.'/phone') }}">绑定手机</a></li>
		<li class="uim-list-item"><a href="{{ url('user/'.$data->id.'/email') }}">绑定邮箱</a></li>
		<li class="uim-list-item"><a href="{{ url('user/'.$data->id.'/postaddress') }}">收货地址</a></li>
	</ul>
</div>
<script>
	$('.uim-list-item').each(function(index, el) {
		$(this).hover(function() {
			$(this).find('a').css('color', '#f40');
		}, function() {
			$(this).find('a').css('color', '#000');
		});
	});
</script>