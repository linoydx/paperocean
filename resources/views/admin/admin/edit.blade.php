
@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="post" action="{{ url('admin/'.$data['admin']->id) }}" enctype="multipart/form-data" >
		@method('PUT')
    	{{csrf_field()}}
    	<script>
    		$(function() {
    			optionSelected = $('select').find("option[value = '{{ $data['admin']->role_id }}']").attr('selected','selected');
    		});
    	</script>
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
        	<tr>
                <td class="label">角色列表：</td>
                <td>
                	<select name="role_id">
                		@if (!empty($data['role']))
                			@foreach ($data['role'] as $role)
               				<option value="{{ $role->id }}">{{ $role->role_name }}</option>
               				@endforeach
               			@endif
					</select>
                </td>
            </tr>
            <tr>
                <td class="label">用户名：</td>
                <td>
                    <input  type="text" name="username" value="{{ $data['admin']->username }}"/>
                </td>
            </tr>
            <tr>
                <td class="label">工号：</td>
                <td>
                    <input type="text" size="25" name="jobnumber" value="{{ $data['admin']->jobnumber }}"/>
                </td>
            </tr>
            <tr>
                <td class="label">电话：</td>
                <td>
                    <input type="text" size="25" name="telephone" value="{{ $data['admin']->telephone }}"/>
                </td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
            
        </table>
    </form>

 @endsection