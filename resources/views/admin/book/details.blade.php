@extends('layouts.admin.app')

@section('content')
<div>
    @if(session('msg'))
        <p>{{ session('msg') }}</p>
    @endif
</div>
<table cellspacing="1" cellpadding="3" width="100%">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    @if (!empty($data))
    <tr>
        <td class="label">图书分类：</td>
        <td>
            <div>
                <span>顶级分类：</span>
                <span>{{$data['cate'][1]->cate_name}}</span>
                <br>
                <span>二级分类：</span>
                <span>{{$data['cate'][0]->cate_name}}</span>
            </div>     
        </td>
    </tr>                
            
    <tr>
        <td class="label">图书名称：</td>
        <td>
            {{$data['book']->book_name}}
        </td>
    </tr>

    <tr>
        <td class="label">图书图片：</td>
        <td>
            @foreach($data['book_pic'] as $v)
            <img id="tmp" src="{{ url($v->pic) }}" width="60px" height="60px">
            @endforeach
        </td>
    </tr>

    <tr>
        <td class="label">图书介绍：</td>
        <td>
            {{$data['book']->book_title}}
        </td>
    </tr>
    <script>
        $(function() {
            $('.is-hot').find("input[value="+"{{$data['book']->is_shop}}"+"]").attr('checked', 'true');
            $('.is-shop').find("input[value="+"{{$data['book']->is_shop}}"+"]").attr('checked', 'true');
        });     
    </script>
    <tr>
        <td class="label">是否热门：</td>
        <td class="is-hot">
            <input id="is-hot" type="radio" name="is_hot" value="1"><span>是</span>
            <input id="no-hot" type="radio" name="is_hot" value="0"><span>否</span>
        </td>
    </tr>
    <tr>
        <td class="label">是否上架：</td>
        <td class="is-shop">
            <input id="is-shop" type="radio" name="is_shop" value="1"><span>是</span>
            <input id="no-shop" type="radio" name="is_shop" value="0"><span>否</span>
        </td>
    </tr>
            
    <tr>
        <td class="label">库存数量：</td>
        <td>
            {{$data['book']->book_number}}
        </td>
    </tr>

    <tr>
        <td class="label">指导价格：</td>
        <td>
            {{$data['book']->guide_price}}
        </td>
    </tr>

    <tr>
        <td class="label">实际价格：</td>
        <td>
            {{$data['book']->shop_price}}
        </td>
    </tr>
    @endif
    <tr>
        <td id="book_action">
        </td>
        <td>
            <a href="{{ url('book/'.$data['book']->id.'/edit') }}">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="">返回</a>
        </td>
    </tr>
</table>
    <script>
    $(function() {
        // 检查是否存在详细信息
        $.get("{{ url('bookinfo/'.$data['book']->id.'/check') }}", function(data) {
            // 如果存在生成显示连接
            if (data.status == 0) {
                $('#book_action').append("<a href="+"{{ url('bookinfo/'.$data['book']->id.'/show')}}"+"><span>显示详细信息&gt;&gt;</span></a><br/>")
            } else {
                // 如果不存在生成添加连接
                $('#book_action').append("<a href="+"{{ url('bookinfo/'.$data['book']->id.'/create')}}"+"><span>添加详细信息&gt;&gt;</span></a><br/>")
            }
        });
        // 检查是否存在描述
        $.get("{{ url('bookdes/'.$data['book']->id.'/check') }}", function(data) {
            // 如果存在生成显示连接
            if (data.status == 0) {
                $('#book_action').append("<a href="+"{{ url('bookdes/'.$data['book']->id.'/show')}}"+"><span>显示图书描述&gt;&gt;</span></a><br/>")
            } else {
                // 如果不存在生成添加连接
                $('#book_action').append("<a href="+"{{ url('bookdes/'.$data['book']->id.'/create')}}"+"><span>添加图书描述&gt;&gt;</span></a><br/>")
            }
        });
    }) 
    </script>

 @endsection 