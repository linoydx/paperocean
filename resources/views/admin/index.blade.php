
@extends('layouts.admin.app')

@section('content')
<!-- header -->
<div class="top">
        <div class="menu">
                <img src="{{ asset('/public/img/admin/menu.png') }}">
        </div>
        <div class="headline">
            <p><i>&nbsp;&nbsp;&nbsp;&nbsp;P&nbsp;&nbsp;A&nbsp;&nbsp;P&nbsp;&nbsp;E&nbsp;&nbsp;R&nbsp;&nbsp;O&nbsp;&nbsp;C&nbsp;&nbsp;E&nbsp;&nbsp;A&nbsp;&nbsp;N</i></p>
        </div>
        
        <div class="person">
            <div class="person-main">
                <div class="person-main-photo">
                	@if (session('admin_name'))
                    <p> hi,{{ session('admin_name') }}</p>
                    @endif
                </div>
                <div class="person-main-list">
                        <ul id="per-list">
                            <li><a href=""><span>个人中心</span></a></li>
                            <li><a href=""><span>设置</span></a></li>
                            <li><a href="{{ url('admin/logout') }}"><span>退出</span></a></li>
                        </ul>
                </div>
            </div>
            <div class="person-notice">
                <img src="{{ asset('/public/img/admin/notice.png') }}">
            </div>
        </div>
        <div class="search">
            <div class="search-1">
                <button type="submit"><img src="{{ asset('/public/img/admin/search.png') }}"></button>
            </div>
            <div class="search-2">
                <input type="search" name="search" placeholder="Search...">
            </div>
        </div>  
    </div>
    <!-- 侧边栏 -->
<div class="sidebar">
	<div class="side-top">
	<div class="side-top-ct"><span>功能列表</span></div>
	</div>
	<div class="side-content">
		<ul class="side-list">
			<li class="side-item">
				<div class="side-item-main">
                    <a href="{{ url('/admin/home') }}">
					<img src="{{ asset('/public/img/admin/home.png') }}">
					<span id="icon">首页</span>
                    </a>
				</div>
			</li>
			@if ($data)
				@foreach ($data as $pri)
					@if ($pri->pid == 0)
					<li class="side-item">
						<div class="side-item-main">
							<img src="{{ asset('/public/img/admin/category.png') }}">
							<span id="icon">{{ $pri->pri_name }}</span>
						</div>
						<div class="side-item-extra">
							<ul>
								@if ($pri->children)
									@foreach ($pri->children as $c_pri)
									<li class=""><a href="{{ url("$c_pri->pri_route") }}" target="main"><span>{{ $c_pri->pri_name }}</span></a></li>
									@endforeach
								@endif
							</ul>
						</div>
					</li>
					@endif
				@endforeach
			@endif
		</ul>
	</div>
</div>
    <!-- 主体页面 -->
<div class="main">
    <p>欢迎进入paperocean管理中心</p>
    <iframe src="" frameborder="0" name="main" width="1200px" height="1000px"></iframe>
</div>

@endsection