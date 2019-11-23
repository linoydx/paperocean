
@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="post" action="{{ url('pri/'.$data['pri']->id) }}" enctype="multipart/form-data" >
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
        <table cellspacing="1" cellpadding="3" width="100%">
            @if(!empty($data['pri']))
            <tr>
                <td class="label">权限名称：</td>
                <td>
                    <input type="text" name="pri_name" value="{{ $data['pri']->pri_name }}">
                </td>
            </tr>
                @if ($data['pri']->is_top == 1)
                <tr id="top_radio">
                    <td class="label">是否为顶级权限：</td>
                    <td id="radio">
                        <input id="is_top" type="radio" name="is_top" value="1" checked=""><span>是</span>
                        <input id="no_top" type="radio" name="is_top" value="0"><span>否</span>
                    </td>
                </tr>
                @else
                <tr id="top_radio">
                    <td class="label">是否为顶级权限：</td>
                    <td id="radio">
                        <input id="is_top" type="radio" name="is_top" value="1"><span>是</span>
                        <input id="no_top" type="radio" name="is_top" value="0" checked=""><span>否</span>
                    </td>
                </tr>
                    @if (!empty($data['top_pris']))
                    <tr id='top_pri'>
                        <td class='label'>父级权限：</td>
                        <td>
                        <script>
                            $(function() {
                                $('#pri_pid').find("option[value="+"{{$data['pri']->pid}}"+"]").attr('selected', 'true');
                            });
                        </script>
                            <select id='pri_pid' name='pid'>
                            @foreach ($data['top_pris'] as $top_pri)
                                <option value="{{ $top_pri->id }}">{{ $top_pri->pri_name }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    @endif
                @endif
            <tr>
                <td class="label">权限路由：</td>
                <td>
                    <input type="text" name="pri_route" value="{{ $data['pri']->pri_route }}">
                </td>
            </tr>
            <tr>
                <td class="label">权限描述：</td>
                <td>
                    <input type="text" name="pri_description" value="{{ $data['pri']->pri_description }}">
                </td>
            </tr>
            
            
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 提交 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
            @endif
        </table>
    </form>
    <script>
        $("input:radio").change(function(event) {
            if ($('#no_top').is(':checked')) {
                $.get("{{ url('pri/top') }}", function(data) {
                    $('#top_radio').after("<tr id='top_pri'><td class='label'>父级权限：</td><td><select name='pid' id='pri_pid'></select></td></tr>")
                    $.each(data,function(i, pri) {
                        $('#pri_pid').append("<option value="+pri['id']+">"+pri['pri_name']+"</option>");
                    });
                });
            }
            if ($('#is_top').is(':checked')) {
                $('#top_pri').css('display', 'none');
            }
        });
    </script>

 @endsection