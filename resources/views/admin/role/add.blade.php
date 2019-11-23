@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="POST" action="{{ url('role') }}" enctype="multipart/form-data" >
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
            <tr>
                <td class="label">角色名称：</td>
                <td>
                    <input type="text" name="role_name" value="" required="required">
                </td>
            </tr>

            <tr>
                <td class="label">角色描述：</td>
                <td>
                    <input type="text" name="role_description" value="">
                </td>
            </tr>
            <tr>
                <td class="label">角色权限：</td>
                @if ($data)
                <td id="pri_check">
                    <table>
                        <tr>
                    @foreach ($data as $pri)
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
                    <input type="submit" class="button" value=" 添加 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
    <script>
        $(function(){
            var checkboxs = $('.checkbox');
            var child_checkboxs = $('.child_checkbox');
            // 选择子权限时，同时选定父权限
            $.each(child_checkboxs,function(i, ele) {
                $(this).change(function(event) {
                    // console.log(1);
                    if ($(this).prop('checked')) {
                        // console.log(2);
                        var pid = parseInt($(this).attr('pid'));
                        $.each(checkboxs,function(i, ele) {
                            // console.log(3);
                            if (parseInt($(this).val()) == pid) {
                                // console.log(111);
                                $(this).attr('checked', 'true');
                            }
                        });
                    }
                });            
            });
        })
    </script>
 @endsection