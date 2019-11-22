/**
 * 
 * book页面js
 */
$(function() {
	// book中图图片
	var pic_m_img = $('#bp-m').find('img');
	// book小图列表项
	var pic_li = $("#bp-s").find('li');
	// book大图图片
	var pic_l_img = $('#bp-l').find('img');
	// 小图列表项选中表现
	pic_li.eq(0).css('border', '2px solid #000');
	pic_li.each(function(i, el) {
		$(this).hover(function() {
			$(this).css('border', '2px solid #000').siblings().css('border', '1px solid #FFFFFF');
			showBookPic(pic_m_img,i);
			showBookPic(pic_l_img,i);
		}, function() {
		});
	});

	// 显示图片
	function showBookPic(elements,index) {
		elements.eq(index).show().siblings('img').hide();
	}

	// 中图显示盒子
	var img_m_box = $('#bp-m');
	// 图片放大镜
	var bp_lens = $('#bp-lens');
	// 图片放大范围盒子
	var bp_lens_box = $('#bp-lens-box');
	// 大图显示盒子
	var img_l_box = $('#bp-l');

	// 光标进入中图盒子
	img_m_box.mouseover(function(event) {
		bp_lens.css('display', 'none');
		bp_lens_box.css('display', 'block');
		img_l_box.css('display', 'block');
	});

	// 光标在中图盒子移动
	img_m_box.mousemove(function(e) {
		// 放大范围盒子top值
		var lens_top;
		// 放大范围盒子left值
		var lens_left;

		// 根据光标坐标计算偏移值
		if (e.clientX <= 215) {
			lens_left = 0;
		} else if (e.clientX >= 425) {
			lens_left = 210;
		} else {
			lens_left = e.clientX -215;
		}
		if (e.clientY <= 235) {
			lens_top = 0;
		} else if (e.clientY >= 445) {
			lens_top = 210;
		} else {
			lens_top = e.clientY -235;
		}

		// 计算大图显示盒子的偏移坐标
		var top_ratio = lens_top/img_m_box.height();
		var left_ratio = lens_left/img_m_box.width();
		var l_img_top = -top_ratio * pic_l_img.height();
		var l_img_left = -left_ratio * pic_l_img.width();

		//偏移值随动 
		bp_lens_box.css({
			top: lens_top,
			left: lens_left
		});
		pic_l_img.css({
			top: l_img_top,
			left: l_img_left
		});
	});

	// 光标离开中图盒子
	img_m_box.mouseout(function(event) {
		bp_lens.css('display', 'block');
		bp_lens_box.css('display', 'none');
		img_l_box.css('display', 'none');
	});

	// 描述评论切换
	$('.binev').each(function(index, el) {
		$(this).click(function(event) {
			$(this).addClass('selected').siblings().removeClass('selected');
			if ($(this).attr('index') == 1) {
				$('#book-des').css('display', 'block');
				$('#book-comment').css('border-top', '2px solid #e3e3e3');
				$('#book-info-attrs').css('display', 'block');
				$('#book-comment-total').css('display', 'none');
			} else {
				$('#book-des').css('display', 'none');
				$('#book-comment').css('border', 'none');
				$('#book-info-attrs').css('display', 'none');
				$('#book-comment-total').css('display', 'block');
			}
		});
	});
});
