/**
 * 
 * @authors linoy (you@example.org)
 * @date    2019-09-17 16:00:40
 * @version $Id$
 */
$(function() {
    /**
     *
     * 分类列表展示
     */
    $('.cate-list').each(function(index, el) {
        $(this).hover(function() {
            $(this).children("div.cn-item").css('background-color', '#999');
            $(this).children('div.cn-expand-content').css('display', 'block');
        }, function() {
            $(this).children("div.cn-item").css('background-color', '#7D0000');
            $(this).children('div.cn-expand-content').css('display', 'none');
        });
    });

    /**
     *
     * 焦点图轮播
     */
    var num = $('.pn-item');
    var pic = $('.pic-list');
    num.each(function(i, el) {
        var offset = -1000*i;
        $(this).click(function(event) {
            showButton(i);
            picAnimate(offset);
        });
    });
            
    var len = 5;
    function showButton(index) {
        num.eq(index).css('background-color', '#7D0000').siblings().css('background-color', '#999');
    }
    function picAnimate(offset) {
        pic.animate({left:offset}, 600,function(){
            var left = parseInt(pic.css('left'));
            if (left > 0) {
                pic.css('left', -1000*len);
            }
            if ( left < -1000*len) {
                pic.css('left', 0);
            }
        });
    }
    var showPic;
    function play(i) {
        showPic = setTimeout(function() {
            showButton(i);
            var offset = -1000*i;
            picAnimate(offset);
            i = i + 1;
            if ( i > 5) {
                i = 0;
            }
            play(i);
        },3000);
    }
    function stop() {
        clearTimeout(showPic);
    }
    $('.pic-roll').hover(function() {
        play(0);
    }, function() {
        stop();
    });

    /**
     * 登录框展示
     */
    $('#login').click(function(event) {
        $('#login-box').css('display', 'block');
    });
    /**
     * 登录框关闭
     */
    $('#box-icon').hover(function() {
        $(this).css('border', '1px solid red');
    }, function() {
        $(this).css('border', '1px solid #E5E5E5');
    });
    $('#box-icon').click(function(event) {
        $('#login-box').css('display', 'none');
    });

    /**
     * 登录成功
     */
    function checkCookie() {
        var username = get;
    }
});