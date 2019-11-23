@extends('layouts.admin.app')

@section('content')

<form name="main_form" method="POST" action="{{ url('admin') }}" enctype="multipart/form-data" >
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
                <td class="label">角色列表：</td>
                <td>
                	<select name="role_id">
                		@if (!empty($data))
                			@foreach ($data as $role)

                			<option value="{{ $role->id }}">{{ $role->role_name }}</option>
                			@endforeach
                		@endif
					</select>
                </td>
            </tr>
            
            <tr>
                <td class="label">用户名：</td>
                <td>
                    <input  type="text" name="username" value="" />
                </td>
            </tr>
            <tr>
                <td class="label">密码：</td>
                <td>
                    <input type="password" size="25" name="password" />
                </td>
            </tr>
            <tr>
                <td class="label">确认密码：</td>
                <td>
                    <input type="password" size="25" name="password_confirmation" />
                </td>
            </tr>
            <tr>
            	<tr>
                <td class="label">工号：</td>
                <td>
                    <input type="text" size="25" name="jobnumber" />
                </td>
            </tr>
            <tr>
            	<tr>
                <td class="label">电话：</td>
                <td>
                    <input type="text" size="25" name="telephone" />
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

 @endsection