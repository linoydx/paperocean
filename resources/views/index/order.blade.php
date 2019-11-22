@extends('layouts.index.home')

@section('content')
@include('layouts.index.top')
<link rel="stylesheet" href="{{ asset('/public/css/Index/orderedit.css') }}">
<div id="order">

	<div id="post-address">
		<div id="pa-title">确认收货信息</div>
		<ul id="pa-list">
		@if(!empty($data['post']))
		@foreach ($data['post'] as $post)
			@if( $post->is_default == 0)
			<li class="pa-list-item pa-list-selected">
				<p class="pa-id" style="display: none">{{ $post->id }}</p>
				<p class="pa-name"><span>收货人：</span>{{$post->ship_realname}}</p>
				<p class="pa-tele"><span>收货电话：</span>{{ $post->ship_telephone }}</p>
				<p class="pa-address"><span>收货地址：</span>{{ $post->ship_address }}</p>
			</li>
			@else
			<li class="pa-list-item">
				<p class="pa-id" style="display: none">{{ $post->id }}</p>
				<p class="pa-name"><span>收货人：</span>{{$post->ship_realname}}</p>
				<p class="pa-tele"><span>收货电话：</span>{{ $post->ship_telephone }}</p>
				<p class="pa-address"><span>收货地址：</span>{{ $post->ship_address }}{{ $post->ship_address }}{{ $post->ship_address }}{{ $post->ship_address }}{{ $post->ship_address }}11111</p>
			</li>
			@endif
		@endforeach
		@endif
		</ul>
		<div id="pa-button"><button id="pab-left">+添加新地址</button> <button id="pab-right">更多</button></div>
	</div>
	<div id="order-box">
		<div id="ob-header">
			<div id="ob-titles">确认订单信息</div>
			<div id="ob-title">
				<div class="obt-item ob-book">商品</div>
				<div class="obt-item ob-attr">属性</div>
				<div class="obt-item ob-price">单价</div>
				<div class="obt-item ob-num">数量</div>
				<div class="obt-item ob-tip">优惠方式</div>
				<div class="obt-item ob-total">小计</div>
			</div>
		</div>
		<div id="ob-main">
			@if (!empty($data['order']))
			<input class="order-id" type="hidden" name="order_id" value="{{ $data['order']->id }}">
			
			@if (!empty($data['order_books']))
			
			@foreach($data['order_books'] as $book)
			<div class="ob-books">
				<input class="book-id" type="hidden" name="order_book_ids[]" value="{{$book->book_id}}">
				<div class="obt-item ob-book">{{ $book->book_title }}</div>
				<div class="obt-item ob-attr">属性</div>
				<div class="obt-item ob-price book-price">{{ $book->shop_price }}</div>
				<div class="obt-item ob-num bn-box">
					<button class="obt-left">-</button>
					<input class="book-num" type="text" name="book_number[]" value="{{ $book->order_book_num }}" width="40px">
					<button class="obt-right">+</button>
				</div>
				<div class="obt-item ob-tip">优惠方式</div>
				<div class="obt-item ob-total book-total" id="ob-total">{{ $book->order_book_cost }}</div>
			</div>
			@endforeach
			@endif
			<form  method="post" action="{{ url('order/'.$data['order']->id) }}">
				@method('PUT')
				{{ csrf_field() }}
			<div id="ob-post">
				<div id="obp-box">
					<div id="obp-wrap">
						<div id="obp-invoice"><input type="radio">开具发票</div>
						<div id="obp-style"><p>运送方式：</p><p>普通配送快递 免邮</p><span id="post-cost">{{ $data['order']->post_cost }}</span></div>
					</div>
					<div id="obp-note"><span>给卖家留言：</span><span><textarea name="order_msg" id="" cols="20" rows="3"></textarea></span></div>
				</div>
				<div id="obp-cost">店铺合计（含运费）<span>￥{{ $data['order']->pay_total }}</span></div>
			</div>
			<div id="ob-sub-box">
				<div id="obs-msg">
					<div id="obs-msg-shadow">
						<div id="order-cost" style="height: 40px;">实付款：<span style="color: #ff0036;font-size: 26px;font-weight: 700;">￥{{ $data['order']->pay_total }}</span></div>
						<div id="order-postadd">寄送至：<span>那些地方</span></div>
						<div id="order-postname">收货人：<span>谁谁谁</span></div>
						<input id="pay_total" type="hidden" name="pay_total" value="{{ $data['order']->pay_total }}">
						<input id="order_postadd_id" type="hidden" name="user_shipinfo_id" value="">
					</div>
				</div>
				<div id="obs-button">
					<input id="" type="submit" value="提交订单">
				</div>
			</div>
			</form>
			@endif
		</div>
	</div>
</div>
<script>
	/**
	 * ajax提交订单book数量等
	 * @param  {[type]} index [description]
	 * @return {[type]}       [description]
	 */
	function putOrderBook(index){
		var order_id = $('.order-id').val();
		var book_id = $('.book-id').eq(index).val();
		var book_num = parseInt($('.book-num').eq(index).val());
		var book_price = $('.book-price').eq(index).text();
		$.post("{{url('/order')}}/"+order_id+'/setBook', 
			{'_token':"{{ csrf_token() }}",'book_id':book_id ,'book_num':book_num,'book_price':book_price} ,
			function(data) {
				console.log(data);
				if (data.status == 0) {
					var book_total = toDecimal(data.book_cost);
					$('.book-total').eq(index).text(book_total);
					setCost(data.pay_total);
				} else {
					var book_total  = toDecimal(data.book_cost);
					var book_num = data.book_num;
					$('.book-num').eq(index).prop('value', book_num);
					$('.book-total').eq(index).text('￥'+book_total);
					setCost(data.pay_total);
				}
		});
	}
	// 设置订单总价
	function setCost(num) {
		$('#obp-cost').children('span').text('￥'+num);
		$('#order-cost').children('span').text('￥'+num);
		$('#pay_total').prop('value', num);
	}
	// book数量左边减一按钮
	$('.obt-left').each(function(index, el) {
		$(this).click(function(event) {
			var book_num = parseInt($(this).next('input').val());
				if (book_num > 1) {
					$(this).css('background-color', '#fff');
					book_num -= 1;
					$(this).siblings('input').prop('value',book_num);
					putOrderBook(index);
					
				} else {
					$(this).css('background-color', '#f7f8fa');
					alert('至少购买一件！');
				}
		});
	});
	// book数量右边加一按钮
	$('.obt-right').each(function(index, el) {
		$(this).click(function(event) {
			var book_num = parseInt($(this).prev('input').val());
				$(this).css('background-color', '#fff');
				book_num += 1;
				$(this).siblings('input').prop('value',book_num);
				putOrderBook(index);
		});
	});
	// book数量输入框的值改变事件
	$('.book-num').each(function(index, el) {
		$(this).change(function(event) {
			var book_num = parseInt($(this).val());
				if (book_num < 1) {
					$(this).val('1');
					alert('至少购买一件！');
				}
				putOrderBook(index);
		});
	});
</script>
<script src="{{ asset('/public/js/Index/orderedit.js') }}"></script>
@include('layouts.index.footer')
@endsection