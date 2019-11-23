@extends('layouts.index.home')

@section('content')
@include('layouts.index.top')
@include('layouts.index.search')
<link rel="stylesheet" href="{{ asset('/public/css/Index/book.css') }}">
<div id="book">
	<div id="book-show">
		@if(!empty($data['book_pic']))
		<div id="bp-l">
			@foreach ($data['book_pic'] as $book_pic)
				<img src="{{ asset($book_pic->pic) }}" alt="" width='840px' height='840px'>
			@endforeach
		</div>
		<div id="book-pic">
			<div id="bp-m">
				<span id="bp-lens"></span>
				<span id="bp-lens-box"></span>
				@foreach ($data['book_pic'] as $book_pic)
				<img src="{{ asset($book_pic->pic) }}" alt="" width='420px' height='420px'>
				@endforeach
			</div>
			<ul id="bp-s">
				@foreach ($data['book_pic'] as $book_pic)
				<li><img src="{{ asset($book_pic->pic) }}" alt="" width="60px" height="60px"></li>
				@endforeach
			</ul>
		</div>
		@endif
		@if(!empty($data['book']))
		<div id="book-details">
			<p id="book-title">{{$data['book']->book_title}}</p>
			<div id="book-price">
				<dl>
					<dt class="bp-title">价格：</dt>
					<dd><em class="bp-yen">￥</em><span class="bp-guide">{{$data['book']->guide_price}}</span></dd>
					
					<dt class="bp-title">优惠价：</dt>
					<dd><em class="bp-yen" id="bp-yen-shop">￥</em><span class="bp-shop">{{$data['book']->shop_price}}</span></dd>
				</dl>
			</div>
			<div id="express">
				<p>运费:￥12.00</p>
			</div>
			<ul id="book-inf">
				<li>月销量</li>
				<li>累计评价</li>
				<li>送会员积分20分</li>
			</ul>
			<form method="POST" action="{{ url('order') }}" enctype="multipart/form-data">
				{{csrf_field()}}
				<input type="hidden" name="book_id" value="{{ $data['book']->id }}">
				<input type="hidden" name="book_price" value="{{ $data['book']->shop_price }}">
				<input type="hidden" name="post_cost" value="12.00">
				<ul>
					<li class="form-in">
						<label for="">书名：</label>
						<span>{{ $data['book']->book_name }}</span>
					</li>
					<li class="form-in">
						<label for="">数量：</label>
						<input id="book-num" type="number" name="book_number" value="1">
						<span>库存{{$data['book']->book_number}}件</span>
					</li>
					<li class="form-in">
						<input id="form-submit" type="submit" value="立即购买">
						<button id="form-button">加入购物车</button>
					</li>
				</ul>
			</form>
			<dl id="book-service">
				<dt>服务承诺</dt>
				<dd>
					<span class="bkse-i">正品保障</span>
					<span class="bkse-i">极速退款</span>
					<span class="bkse-i">七天无理由退换</span>
				</dd>
			</dl>
		</div>
	</div>
	<div id="book-extra">
		<div id="book-hot"></div>
		<div id="book-info-box">
			<div id="book-info-main">
				<div id="book-info-nev">
					<ul>
						<li class="binev selected" index='1'>
							<span>图书详情</span>
						</li>
						<li class="binev" index='2'>
							<span>累计评价</span>
						</li>
					</ul>
				</div>
				<div id="book-info-attrs">
					<p id="book-attr">图书参数：</p>
					<ul id="book-attr-list">
						<li>书名：{{$data['book']->book_name}}</li>
						<li>作者：{{$data['book']->book_writer}}</li>
						<li>出版商：{{$data['book']->book_publisher}}</li>
						<li>ISBN：{{$data['book']->book_ISBN}}</li>
						<li>开数：{{$data['book']->book_format}}开</li>
						<li>总字数：{{$data['book']->book_words_num}}字</li>
						<li>总页数：{{$data['book']->book_page_num}}页</li>
						<li>出版日期：{{$data['book']->book_publication_data}}</li>
						<li>印刷日期：{{$data['book']->book_print_data}}</li>
					</ul>
				</div>
				
			</div>
			<div id="book-des">
				<hr>
			{!! $data['book']->book_description !!}
			</div>
			<div id="book-comment">
				<div id="book-comment-total">
					<div id="bc-header">
						<div id="bc-score">
							<h4>与描述相符</h4>
							<strong>4.9</strong>
							<p><img src="{{ asset('/public/img/index/icon-wuxing.png') }}" alt=""></p>
						</div>
						<div id="bc-title">
							<div id="bc-title-label">
								<span>大家都写到</span>
							</div>
							<div id="bc-title-list">
								<span class="bc-title-item"><a href="#">宝贝不错（113）</a></span>
								<span class="bc-title-item"><a href="#">宝贝不错（113）</a></span>
								<span class="bc-title-item"><a href="#">宝贝不错（113）</a></span>
								<span class="bc-title-item"><a href="#">宝贝不错（113）</a></span>
								<span class="bc-title-item"><a href="#">宝贝不错（113）</a></span>
								<span class="bc-title-item"><a href="#">宝贝不错（113）</a></span>
							</div>
						</div>
					</div>
					<div id="bc-toolbar">
						<span id="bc-filter">
							<input type="radio" name="" value="" checked=""><span>全部</span>
							<input type="radio" name="" value=""><span>追评（213）</span>
							<input type="radio" name="" value=""><span>图片（432）</span>
						</span>
						<span id="bc-order">
							<input type="radio" name="" value="" checked="">有内容
							<select name="" id="">
								<option value="">按默认</option>
								<option value="">按时间</option>
							</select>
						</span>
					</div>
				</div>
				<table>
					<tr>
						<td class="bc-m-left">
							<div class="bc-m-details">超级好看，一直都喜欢摆渡人 说到书的质量 那是一个好，正品💖💖</div>
							<div class="bc-m-photos">
								<ul>
									<li><img src="{{ asset($book_pic->pic) }}" alt="" width='40px' height='40px'></li>
								</ul>
								
							</div>
							<div class="bc-m-data">
								12.09
							</div>
						</td>
						<td calss="bc-m-right">
							<div class="bc-m-user">sdadasda(匿名)</div>
						</td>
					</tr>
					<tr>
						<td class="bc-m-left">
							<div class="bc-m-details">超级好看，一直都喜欢摆渡人 说到书的质量 那是一个好，正品💖💖</div>
							<div class="bc-m-photos">
								<ul>
									<li><img src="{{ asset($book_pic->pic) }}" alt="" width='40px' height='40px'></li>
								</ul>
								
							</div>
							<div class="bc-m-data">
								12.09
							</div>
						</td>
						<td calss="bc-m-right">
							<div class="bc-m-user">sdadasda(匿名)</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	@endif
</div>
<script src="{{ asset('/public/js/Index/book.js') }}"></script>
@include('layouts.index.footer')
@endsection