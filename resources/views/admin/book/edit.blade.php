@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="POST" action="{{ url('book/'.$data['book']->id) }}" enctype="multipart/form-data" >
    @method('PUT')
    {{csrf_field()}}
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
                    <span>顶级分类：</span>
                    
                    
                    <select id="topcate" name="pcate_id">
                        <!-- <option value="">{{ $data['cate'][1]->cate_name }}</option> -->
                    </select>

                    <br/>
                    <span>二级分类：</span>
                    <select id="nextcate" name="cate_id">
                        
                        <!-- <option value="">{{ $data['cate'][0]->cate_name }}</option> -->
                        
                    </select>
                </td>
            </tr>
                            
            @endif

            <tr>
                <td class="label">图书名称：</td>
                <td>
                    <input type="text" name="book_name" value="{{ $data['book']->book_name }}">
                </td>
            </tr>

            <!-- <tr>
                <td class="label">图书图片：</td>
                <td>
                    <img id="tmp" src="">
                    <input id="img-in" type="file" name="book_picture" value="" multiple="">
                </td>
            </tr> -->

            <tr>
                <td class="label">图书介绍：</td>
                <td>
                    <textarea name="book_title" cols="60" rows="2">{{ $data['book']->book_title }}</textarea>
                </td>
            </tr>
            <tr>
                <td class="label">库存数量：</td>
                <td>
                    <input type="text" name="book_number" value="{{ $data['book']->book_number }}">
                </td>
            </tr>
            <tr>
                <td class="label">是否热门：</td>
                <td>
                 <input class="is-hot" type="radio" name="is_hot" value="1" @if($data['book']->is_hot == 1) {{ 'checked' }}@endif>是
                 <input class="is-hot" type="radio" name="is_hot" value="0" @if($data['book']->is_hot == 0) {{ 'checked' }}@endif>否
                </td>
            </tr>
            <tr>
                <td class="label">是否上架：</td>
                <td>
                    <input class="is-shop" type="radio" name="is_shop" value="1" @if($data['book']->is_shop == 1) {{ 'checked' }}@endif>是
                    <input class="is-shop" type="radio" name="is_shop" value="0" @if($data['book']->is_shop == 0) {{ 'checked' }}@endif>否
                 </td>
            </tr>
            <tr>
                <td class="label">指导价格：</td>
                <td>
                    <input type="text" name="guide_price" value="{{ $data['book']->guide_price }}">
                </td>
            </tr>

            <tr>
                <td class="label">实际价格：</td>
                <td>
                    <input type="text" name="shop_price" value="{{ $data['book']->shop_price }}">
                </td>
            </tr>

            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 提交 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
    <script>

        $(function() {
            //生成顶级分类选择框
            var pid = "{{$data['cate'][1]->pid}}";
            $.get("{{url('cate')}}/"+pid, function(data) {
                // $('#topcate').empty();
                $.each(data, function(i, val) {
                    $('#topcate').append("<option value="+val['id']+">"+val['cate_name']+"</option>");
                });
                $('#topcate').find("option[value='{{ $data['cate'][1]->id }}']").attr('selected','selected');
            });
            // 生成次级分类选择框
            var id = "{{ $data['cate'][1]->id }}";
            $.get("{{url('cate')}}/"+id, function(data) {
                $.each(data, function(i, val) {
                    $('#nextcate').append("<option value="+val['id']+">"+val['cate_name']+"</option>");
                });
                $('#nextcate').find("option[value='{{ $data['cate'][0]->id }}']").attr('selected','selected'); 
            });
            // 两级分类随动
            $('#topcate').change('id',function() {
                var id = $('#topcate').val();
                $.get("{{ url('cate') }}/"+id, function(data) {
                    $('#nextcate').empty();
                    $.each(data, function(i, val) {
                        $("#nextcate").append("<option value ="+val['id']+">"+val['cate_name']+"</option>");
                    });
                });
            });
        });  
    </script>

 @endsection 
