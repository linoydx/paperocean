
@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="post" action="{{ url('role/'.$data['role']->id) }}" enctype="multipart/form-data" >
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
            @if($data['role'])
            <tr>
                <td class="label">角色名称：</td>
                <td>
                    <input type="text" name="role_name" value="{{ $data['role']->role_name }}" required="required">
                </td>
            </tr>

            <tr>
                <td class="label">角色描述：</td>
                <td>
                    <input type="text" name="role_description" value="{{ $data['role']->role_description }}">
                </td>
            </tr>
            <tr>
                <td class="label">角色权限：</td>
                @if ($data['pris'])
                <td id="pri_check">
                    <table>
                        <tr>
                    @foreach ($data['pris'] as $pri)
                        <td><input class="checkbox" type="checkbox" name="role_pri[]" value="{{ $pri->id }}"><span>{{ $pri->pri_name }}</span>
                        
                        @if (!empty($pri->children))
                            <ul>
                            @foreach ($pri->children as $cpri)
                                <li><input pid="{{ $pri->id }}" class="child_checkbox" type="checkbox" name="role_pri[]" value="{{ $cpri->id }}"><span>{{ $cpri->pri_name }}</span></li>
                            @endforeach
                            </ul>
                               
                        @endif 
                        </td>
                    @endforeach
                    </tr>
                    </table>
                </td>
                @endif
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
        $(function() {
            var checkboxs = $('.checkbox');
            var child_checkboxs = $('.child_checkbox');
            // 页面加载完成时，ajax获取角色权限并选定选择框
            $.get("{{ url('role/'.$data['role']->id.'/pris') }}", function(data) {
                var role_pri = new Array();
                $.each(data, function(i, pri) {
                     role_pri.push(pri['pri_id']);
                });
                $.each(checkboxs, function(i,ele) {
                    if ($.inArray(parseInt($(this).attr('value')), role_pri) >= 0) {
                        $(this).attr('checked', 'true');
                    };
                });
                $.each(child_checkboxs, function(i,ele) {
                    if ($.inArray(parseInt($(this).attr('value')), role_pri) >= 0) {
                        $(this).attr('checked', 'true');
                    };
                });
            });
            // 选择子权限时，同时选定父权限
            $.each(child_checkboxs,function(i, ele) {
                $(this).change(function(event) {
                    if ($(this).prop('checked')) {
                        var pid = parseInt($(this).attr('pid'));
                        $.each(checkboxs,function(i, ele) {
                            if (parseInt($(this).val()) == pid) {
                                $(this).attr('checked', 'true');
                            }
                        });
                    }
                });            
            });
        });
    </script>

 @endsection