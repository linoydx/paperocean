@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="post" action="{{ url('cate/'.$data['cate']->id) }}" enctype="multipart/form-data" >
		@method('PUT')
    	{{csrf_field()}}
    	@if ($errors->any())
    		<div class="alert alert-danger">
       			 <ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
    		</div>
			@endif
    	@if(session('msg'))
			<p>{{session('msg')}}</p>
		@endif
        <script>
            $(function() {
                $('select').find("option[value = '{{ $data['cate']->pid }}']").attr('selected','selected');
            });
        </script>
        <table cellspacing="1" cellpadding="3" width="100%">
            @if(!empty($data['cate']))
        	<tr>
                <td class="label">分类名称：</td>
                <td>
                    <input type="text" name="cate_name" value="{{ $data['cate']->cate_name }}">
                </td>
            </tr>    
            <tr id="top_radio">
                <td class="label">是否为顶级权限：</td>
                <td id="radio">
                    @if ($data['cate']->is_top == 1)
                    <input id="is_top" type="radio" name="is_top" value="1" checked=""><span>是</span>
                    <input id="no_top" type="radio" name="is_top" value="0"><span>否</span>
                    @else
                    <input id="is_top" type="radio" name="is_top" value="1"><span>是</span>
                    <input id="no_top" type="radio" name="is_top" value="0" checked=""><span>否</span>
                    @endif
                </td>
            </tr>
            
            @if (!empty($data['top_cates']))
            <tr id='top_cate'>
                <td class='label'>父级分类：</td>
                <td>
                <script>
                    $(function() {
                        $('#cate_pid').find("option[value="+"{{$data['cate']->pid}}"+"]").attr('selected', 'true');
                    });
                </script>
                    <select id='cate_pid' name='pid'>
                    @foreach ($data['top_cates'] as $top_cate)
                        <option value="{{ $top_cate->id }}">{{ $top_cate->cate_name }}</option>
                    @endforeach
                    </select>
                </td>
            </tr>
            @endif
            @endif           
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value="提交" />
                    <input type="reset" class="button" value="重置" />
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