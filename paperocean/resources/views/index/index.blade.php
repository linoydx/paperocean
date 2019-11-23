@extends('layouts.index.home')

@section('content')
@include('layouts.index.top')
@include('layouts.index.search')
<div id="header" > 
    	<div class="cate-nav">
            <ul>
                <li class="cate-list">
                    <div class="cn-item">
                        <div class="cn-item-category">童书/育儿</div>
                        <a class="cn-item-cell" href="">儿童文学</a>
                        <a class="cn-item-cell" href="">绘本</a>
                        <a class="cn-item-cell" href="">启蒙书</a>
                    </div>
                    <div class="cn-expand-content" style="display: none">
                        <div class="cate-box">
                            <div class="box-title">儿童文学</div>
                            <div class="box-container">
                                <a class="box-a" href="">测试测试</a>
                                <a class="box-a" href="">测试测试</a>
                                <a class="box-a" href="">测试测试</a>
                                <a class="box-a" href="">测试测试</a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">科普读物</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">启蒙认知</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">亲子读物</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">绘本</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="cate-list">
                    <div class="cn-item">分类</div>
                     <div class="cn-expand-content" style="display: none">
                        <div class="cate-box">
                            <div class="box-title">儿童文学</div>
                            <div class="box-container">
                                <a class="box-a" href="">测试测试</a>
                                <a class="box-a" href="">测试测试</a>
                                <a class="box-a" href="">测试测试</a>
                                <a class="box-a" href="">测试测试</a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">科普读物</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">启蒙认知</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">亲子读物</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                        <div class="cate-box">
                            <div class="box-title">绘本</div>
                            <div class="box-container">
                                <a href=""></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="cate-list">
                    <div class="cn-item">分类</div>
                </li>
                <li class="cate-list">
                    <div class="cn-item">分类</div>
                </li>
                <li class="cate-list">
                    <div class="cn-item">分类</div>
                </li>
                <li class="cate-list">
                    <div class="cn-item">分类</div>
                </li>
            </ul>   
        </div>
        <div class="pic-num">
            <ul class="pn-list">
                <li class="pn-item" style="background-color: #7D0000;">1</li>
                <li class="pn-item">2</li>
                <li class="pn-item">3</li>
                <li class="pn-item">4</li>
                <li class="pn-item">5</li>
                <li class="pn-item">6</li>
            </ul>
        </div>
    	<div class="pic-roll">
            <div class="pic-list">
                <img class="pr-item" src="{{ asset('/public/img/Index/1000-320.png') }}" alt="" width="1000px" height="320px">
                <img class="pr-item" src="{{ asset('/public/img/Index/1049653664.jpg') }}" alt="" width="1000px" height="320px">
                <img class="pr-item" src="{{ asset('/public/img/Index/199002964.jpg') }}" alt="" width="1000px" height="320px">
                <img class="pr-item" src="{{ asset('/public/img/Index/291799040.jpg') }}" alt="" width="1000px" height="320px">
                <img class="pr-item" src="{{ asset('/public/img/Index/3082922183.jpg') }}" alt="" width="1000px" height="320px">
                <img class="pr-item" src="{{ asset('/public/img/Index/718103769.jpg') }}" alt="" width="1000" height="320">
            </div>
    	</div>
    </div>
    <div id="book-group">
        <div class="bg-floor">
            <h1>1F 少儿图书TOP</h1>
            <hr/>
            <div class="content">
                <a href=""><img src="{{ asset('/public/img/Index/HpXX-460-780.jpg') }}" alt="" width="230" height="390"></a>
                <div class="products">
                    <ul class="pd-list">
                        <li class="pd-item"><a href="">儿童文学</a></li>
                        <li class="pd-item"><a href="">涂色绘本</a></li>
                        <li class="pd-item"><a href="">低幼启蒙</a></li>
                    </ul>
                    <div class="product active">
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="{{ asset('/public/img/Index/TB-item_pic.jpg') }}" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网正版 三年级 四年级五年级四五 上海译文出版社全套怀特书籍小学生课外书必读图书故事绘本小说经典名著阅读书儿童文学</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-floor">
            <h1>1F 少儿图书TOP</h1>
            <hr/>
            <div class="content">
                <a href=""><img src="HpXX-460-780.jpg" alt="" width="230" height="390"></a>
                <div class="products">
                    <ul class="pd-list">
                        <li class="pd-item"><a href="">儿童文学</a></li>
                        <li class="pd-item"><a href="">儿童文学</a></li>
                        <li class="pd-item"><a href="">儿童文学</a></li>
                    </ul>
                    <div class="product active">
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                        <a href="" class="pa-item">
                            <div class="img">
                                <img src="TB-item_pic" alt="" width="220" height="220">
                            </div>
                            <p class="title">夏洛的网</p>
                            <p class="price"><span>￥</span>18.2</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.index.footer')
@endsection