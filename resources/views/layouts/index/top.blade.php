<!-- 页面顶部 -->    
<div id="top-side">
    <div class="ts-left">
        <a href="{{url('')}}">首页</a>
        @if(session('username'))
            <span id="weluser"><b>hi,</b><a href="{{ url('person/'.session('user_id')) }}">{{ session('username') }}</a>
            </span>
            <a id="msg" href="">消息<span>0</span></a>
            <a id="logout"  href="{{ url('logout') }}"><span>退出</span></a>
        @else
            <span id="wel">Welcome to PaperOcean!</span>
            <span id="login"><a href="javascript:;">请登录</a></span>
            <a id="regist" href="{{ url('regist') }}">免费注册</a>
        @endif
    </div>
    <div class="ts-right">
        <ul>
            <li class="ts-item">我的书架</li>
            <li class="ts-item">购物车</li>
            <li class="ts-item">收藏夹</li>
            <li class="ts-item">帮助中心</li>
        </ul>
    </div>
</div>
<div id="login-box" style="display: none;">
    <div id="box-icon">
        <img src="{{ asset('/public/img/index/icon.png') }}" alt="" width="20px" height="20px">
    </div>
    <div>
        @if(session('msg'))
            <p>{{session('msg')}}</p>
        @endif
    </div>
    <form id="login-form" action="{{ url('/login') }}" method="post">
        {{csrf_field()}}
        <span style="color: black;"><b>用户名</b></span><input type="text" name="username" value="">
        <span style="color: black;"><b>密&nbsp;&nbsp;&nbsp;码</b></span><input type="password" name="password" value="">
        <input id="login-button" type="submit" value="登&nbsp;&nbsp;录">
        <div id="login-extra">
            <a href="">忘记密码</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('regist') }}">免费注册</a>
        </div>
    </form>
</div>