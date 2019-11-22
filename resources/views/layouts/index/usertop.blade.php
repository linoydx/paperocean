<style>
	#ub-top {
		height: 36px;
		background: #FF4401;
		padding: 12px 80px;
		position: relative;
		z-index: 5;
		border-bottom: 1px solid #E7E7E7;
		color: #6d6d6d;
	}
	#ub-top p {
		display: inline-block;
		width: 180px;
		height: 36px;
		margin-top: 12px;
		color: blue;
		font-size: 30px;
		text-align: center;
	}
	#ubt-list {
		position: absolute;
		top: 22px;
		left: 260px;
		display: inline;
		margin-left: 20px;
		width: 800px;
	}
	#ubt-list li {
		width: 100px;
		float: left;
		margin-left: 40px;
		text-align: center;
	}
	.selected {
		position: relative;
	}
	.selected i {
		border-style: solid;
    	border-width: 6px;
    	font-size: 0;
    	height: 0;
    	line-height: 0;
    	position: absolute;
    	width: 0;
    	border-color: #ff4401 #ff4401 #fff;
    	left: 50%;
    	margin-left: -6px;
    	box-shadow: 0 1px 0 #fff;
    	bottom: -13px;
	}
	#ubt-list li a {
		color: #FFFFFF;
		font-size: 18px;
		font-weight: 300;
	}
</style>
<div id="ub-top">
	<p>PaperOcean</p>
	<ul id="ubt-list">
		<li id="ubt-order" class="selected"><a href="{{ url('person/'.session('user_id')) }}">首页</a><i></i></li>
		<li id="ubt-info"><a href="{{ url('user/'.session('user_id').'/index') }}">账户设置</a></li>
		<li id="ubt-msg"><a href="#">消息</a></li>
	</ul>
</div>