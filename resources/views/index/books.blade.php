@extends('layouts.index.home')
@section('content')
<link rel="stylesheet" href="{{ asset('/public/css/Index/books.css') }}">
@include('layouts.index.top')
@include('layouts.index.search')
<div id="books-box">
	<div id="books-box-cates">
		<div id="bbc-cates">
			分类
		</div>
		<div id="bbc-cate-main">
			<div id="bbc-cate-list">
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
				<a class="bbc-cate-item" href="">分类</a>
			</div>
			<div id="bbc-button">更多</div>	
		</div>
		
	</div>
	<div id="books">
		<div class="book">
			<a href="{{ url('book/1/show') }}" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/T14b9CFT4XXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<div id="order-icon"><p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p></div>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1FNXeLXXXXXcyXFXXXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1HGH.bMkLL1JjSZFpXXa7nFXa_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="{{ url('book/1/show') }}" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/T14b9CFT4XXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<div id="order-icon"><p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p></div>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1FNXeLXXXXXcyXFXXXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1HGH.bMkLL1JjSZFpXXa7nFXa_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="{{ url('book/1/show') }}" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/T14b9CFT4XXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<div id="order-icon"><p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p></div>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1FNXeLXXXXXcyXFXXXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1HGH.bMkLL1JjSZFpXXa7nFXa_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="{{ url('book/1/show') }}" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/T14b9CFT4XXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<div id="order-icon"><p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p></div>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1FNXeLXXXXXcyXFXXXXXXXXXX_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
		<div class="book">
			<a href="" target="_blank"><img id="book-img" src="{{ asset('/public/img/index/TB1HGH.bMkLL1JjSZFpXXa7nFXa_!!0-item_pic.jpg') }}" alt=""></a>
			<p id="book-price">18.80</p>
			<p id="book-title">测试测试测试</p>
			<p id="order-num">月成交423笔</p><p id="comment-num">评价1212</p>
		</div>
	</div>
</div>
<script>
	/**
	 * 分类列表切换
	 */
	$('#bbc-button').click(function(event) {
		var button_text = $(this).text();
		if (button_text == "更多") {
			$(this).text('收起');
			$('#books-box-cates').css({
				height: '80px',
				overflow: 'show'
			});;
			return true;
		}
		$(this).text('更多');
		$('#books-box-cates').css({
			height: 'auto',
			overflow: 'hidden'
		});
	});

	/**
	 *焦点图书
	 */
	$('.book').each(function(index, el) {
		$(this).hover(function() {
			$(this).css('border-color', 'red');
		}, function() {
			$(this).css('border-color', '#FFFFFF');
		});
	});
</script>
@endsection