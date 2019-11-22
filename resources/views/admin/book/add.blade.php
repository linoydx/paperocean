@extends('layouts.admin.app')

@section('content')
<link rel="stylesheet" href="{{ asset('/resources/org/kindeditor/themes/default/default.css') }}">
<link rel="stylesheet" href="{{ asset('/resources/org/kindeditor/plugins/code/prettify.css') }}">
<form name="main_form" method="POST" action="{{ url('book') }}" enctype="multipart/form-data" >
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
            <div>
                @if(session('msg'))
                <p>{{ session('msg') }}</p>
                 @endif
            </div>

            @if (!empty($data))
            <tr>
                <td class="label">图书分类：</td>
                
                <td>
                    <span>顶级分类：</span>
                    
                    
                    <select id="topcate" name="pcate_id">
                        <option value="" selected="">请选择</option>
                        @foreach ($data as $v)
                        <option value="{{ $v->id }}">{{ $v->cate_name }}</option>
                        @endforeach
                    </select>

                    <br/>
                    <span>二级分类：</span>
                    <select id="nextcate" name="cate_id">
                        
                        <option value="" selected="">请选择</option>
                        
                    </select>
                </td>
            </tr>
                            
            @endif

            <tr>
                <td class="label">图书名称：</td>
                <td>
                    <input type="text" name="book_name" value="" required="required">
                </td>
            </tr>

            <tr>
                <td class="label">图书图片：</td>
                <td>
                    <div id="preview"></div>
                    <input id="img-in" type="file" name="book_pic[]" value="" multiple="" onchange="previewPic()">
                </td>
            </tr>

        	<tr>
                <td class="label">图书介绍：</td>
                <td>
                    <textarea name="book_title" cols="60" rows="2"></textarea>
                </td>
            </tr>

            <!-- <tr>
                <td class="label">图书描述：</td>
                <td>
                    <textarea name="description" id="book_des"></textarea>
                </td>
            </tr> -->
            
            <tr>
                <td class="label">库存数量：</td>
                <td>
                    <input type="text" name="book_number" value="">
                </td>
            </tr>

            <tr>
                <td class="label">指导价格：</td>
                <td>
                    <input type="text" name="guide_price" value="">
                </td>
            </tr>

            <tr>
                <td class="label">实际价格：</td>
                <td>
                    <input type="text" name="shop_price" value="">
                </td>
            </tr>

            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 添加 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
    <script src="{{ asset('/resources/org/kindeditor/kindeditor-all-min.js') }}"></script>
    <script src="{{ asset('/resources/org/kindeditor/lang/zh-CN.js') }}"></script>
    <script src="{{ asset('/resources/org/kindeditor/plugins/code/prettify.js') }}"></script>
    <script>
        $(function() {
            // 生成分类选择框
            $('#topcate').change('id',function() {
                var id = $('#topcate').val();
                $('#nextcate').find('option').remove();
                $.get("{{ url('cate') }}/"+id, function(data) {
                    $.each(data, function(i, val) {
                        // console.log(val);
                        $("#nextcate").append("<option value = "+val['id']+">"+val['cate_name']+"</option>");
                    });
                });
            });
        });
        // 图片预览
        function previewPic() {
            var files = $('#img-in')[0].files;
            var preview = $('#preview');
            $('img').attr('src','').remove();
            $.each(files, function(i, file) {
                preview.append("<img src='' id='img"+i+"'width='60' height='60'/>");
                $('#img'+i).attr('src', URL.createObjectURL(file));
            });
        } 
        //富文本编辑器
        // KindEditor.ready(function(K) {
        //         window.editor = K.create('#book_des',{
        //             width: '1000px',
        //             height: 'auto',
        //             upload_json: "{{ asset('resources/org/php/upload_json.php') }}",
        //             fileManagerJson : "{{ asset('resources/org/php/fileManagerJson.php') }}",
        //             allowFileManager : true
        //         });
        // }); 
    </script>

 @endsection        
        
