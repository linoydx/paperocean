/**
 * 
 * 
 */
 // 显示更多收货地址切换
	$('#pab-right').click(function(event) {
		var button_text = $(this).text();
		if (button_text == "更多") {
			$(this).text('收起');
			$('#pa-list').css('height','auto');
			return true;
		}
		$(this).text('更多');
		$('#pa-list').css({
			height: '195px'
		});
	});
	$(function() {
		setPostinfo();
		// setCost();
	});
	// 选中地址
	$('.pa-list-item').each(function(index, el) {
		$(this).click(function(event) {
			if (index == 0) {
				return true;
			} else {
				var selected_post = $(this).html();
				var old_selected_post = $('.pa-list-selected').html();
				$(this).html(old_selected_post);
				$('.pa-list-selected').html(selected_post);
			}
		setPostinfo();
		});
	});
	/**
	 * 设置提交的发货信息
	 */
	function setPostinfo() {
		var pa_id = $('.pa-list-selected').children('.pa-id').text();
		var pa_name = $('.pa-list-selected').children('.pa-name').text();
		var pa_address = $('.pa-list-selected').children('.pa-address').text();
		$('#order-postadd').children('span').text(slicestr(pa_address));
		$('#order-postname').children('span').text(slicestr(pa_name));
		$('#order_postadd_id').prop('value', pa_id);
	}
	/**
	 * 截取所需的str
	 * @param  {[type]} str [description]
	 * @return {[type]}     [description]
	 */
	function slicestr(str) {
		var start = str.indexOf('：')+1;
		var end = str.length;
		return str.slice(start,end);
	}
	// 图书数量加减按钮
	var book_number_box = $('.bn-box');
		book_number_box.find('div').each(function(index, el) {
			$(this).hover(function() {
				$(this).css('background-color', '#f7f8fa');
			}, function() {
				$(this).css('background-color', '#fff');
			});
		});
				
	// 转换浮点数并保留两位小数
	function toDecimal(num) {
		var f = parseFloat(num);
			if (isNaN(f)) {
				return false;
			}
		var f = Math.round(num*100)/100;
		var s = f.toString();
		var rs = s.indexOf('.');
			if (rs < 0) {
        		rs = s.length;
        		s += '.';
			}
    		while (s.length <= rs + 2) {
        		s += '0';
        	}
        	return s;
	}
	// 计算一个图书的总价
	function BookTotal(price,num){
		var total = toDecimal(price * num);
			return total;
	}
	// 计算两个数字的和
	function getSum(total,num) {
			return total + num;
	}
	// // 计算并设置页面总价
	// function setCost() {
	// 	// var pay_total = $('#obp-cost').children('span').text();
	// 	// $('#order-cost').children('span').text(pay_total);
	// 	// var book_totals = new Array();
	// 	// 计算每种图书总价
	// 		// book_number_box.each(function(index, el) {
	// 		// 	var book_num = $(this).children('input').val();
	// 		// 	var book_price = $(this).siblings('.book-price').text();
	// 		// 	var book_total = BookTotal(book_price,book_num);
	// 		// 		book_totals[index] = book_total;
	// 		// 		$(this).siblings('.book-total').text(book_total);
	// 		// });
	// 		// 
	// 	// 取到每种图书的总价压入数组中
	// 	// $('.book-total').each(function(index, el) {
	// 	// 	var book_total = $(this).text();
	// 	// 	book_totals[index] = book_total; 
	// 	// });
	// 	// // 计算所有图书总价的和
	// 	// var book_cost = book_totals.reduce(function(a,b){
	// 	// 		return parseFloat(a) + parseFloat(b);
	// 	// 	},0);
	// 	// var post_cost = $('#post-cost').text();
	// 	// var order_cost = toDecimal(parseFloat(post_cost) + book_cost);
	// 	// 	$('#obp-cost').children('span').text('￥'+order_cost);
	// 	// 	$('#order-cost').children('span').text('￥'+order_cost);
	// 	// 	$('#pay_total').prop('value', order_cost);
	// }