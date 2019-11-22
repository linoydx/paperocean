<!-- 页面搜索框 -->
<div id="search">
    <form method="post" action="{{ url('search') }}">
        {{csrf_field()}}
        <input id="search-in" type="search" name="search" value="">
        <input id="submit" type="submit" value="搜索">
    </form>
</div>