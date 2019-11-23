@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="POST" action="{{ url('cate') }}" enctype="multipart/form-data" >
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

            @if(!empty($data))
            @endif
        	<tr>
                <td class="label">分类名称：</td>
                <td>
                    <input type="text" name="cate_name" value="">
                </td>
            </tr>
            <tr id="top_radio">
                <td class="label">是否为顶级分类：</td>
                <td id="radio">
                    <input id="is_top" type="radio" name="is_top" value="1" checked=""><span>是</span>
                    <input id="no_top" type="radio" name="is_top" value="0"><span>否</span>
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
    <script>
        $("input:radio").change(function(event) {
            if ($('#no_top').is(':checked')) {
                $.get("{{ url('cate/top') }}", function(data) {
                    $('#top_radio').after("<tr id='top_cate'><td class='label'>父级分类：</td><td><select name='pid' id='cate_pid'></select></td></tr>")
                    $.each(data,function(i, cate) {
                        $('#cate_pid').append("<option value="+cate['id']+">"+cate['cate_name']+"</option>");
                    });
                });
            }
            if ($('#is_top').is(':checked')) {
                $('#top_cate').css('display', 'none');
            }
        });
    </script>
 @endsection