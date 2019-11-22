<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Models\Admin;
use App\Http\Models\Role;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    // get.admin.index列表页
    public function index()
    {

        $admins = Admin::all();
        foreach ($admins as $k=>$admin) {
            $role_id = $admin->roles()->value('role_id');
            $data[] = Arr::add($admin,'role_id',$role_id);
        }
        return view('admin.admin.lst')->with('data',$data);
    }
    // get.admin.create添加页
    public function create()
    {
        $data = Role::all();
        return view('admin.admin.add')->with('data',$data);
    }
    // post.admin.store添加
    public function store(Request $request)
    {
        $rules = [
            'username' => 'bail|required|alpha_num|max:30|unique:admin',
            'password' => 'required|between:6,20|confirmed',
            'jobnumber' => 'required|numeric|digits_between:0,6',
            'telephone' => 'required|numeric|digits:11',
        ];
        $messages = [
            'username.alpha_num' => '用户名必须是字母加数字！',
            'username.required' => '用户名不能为空！',
            'username.max' => '用户名长度不超过30位！',
            'username.unique' => '用户名已存在！',
            'password.required' =>'密码不能为空！',
            'password.between' =>'密码长度在6-20位之间！',
            'password.confirmed' =>'两次输入密码不匹配！',
            'jobnumber.numeric' =>'工号必须是数字！',
            'jobnumber.required' =>'工号不能为空！',
            'jobnumber.max' =>'工号长度不超过6位！',
            'telephone.numeric' =>'电话必须是数字！',
            'telephone.required' =>'电话不能为空！',
            'telephone.digits' =>'电话长度必须是11位！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
        $input = $request->except('_token','role_id','password_confirmation');
        DB::beginTransaction();
        try {
            $admin = Admin::create($input);
            $admin->roles()->attach($request->input('role_id'));
            DB::commit();
            return redirect()->action('Admin\AdminController@index')->with('msg','添加管理员成功！');
        }
        catch(Exception $e) {
            DB::rollBack();
            return back()->with($request->input());
        }
    }
    // get.admin.show单个用户信息
    public function show($id)
    {
        $admin = Admin::find($id);
        $role_name = $admin->roles()->value('role_name');
        $data[] = Arr::add($admin,'role_name',$role_name);
        return $data;
    }
    // get.admin.edit修改页面
    public function edit($id)
    {
        $role = Role::all();
        $data['role'] = Arr::collapse([$role]);
        $admin = Admin::find($id);
        $role_id = $admin->roles()->value('role_id');
        $data['admin'] = Arr::add($admin,'role_id',$role_id);
        // dd($data);
        return view('admin.admin.edit')->with('data',$data);
    }
    // put.admin.update用户更新
    public function update($id,Request $request)
    {
        $rules = [
            'username' => 'bail|required|alpha_num|max:30',
            'jobnumber' => 'required|numeric|digits_between:0,6',
            'telephone' => 'required|numeric|digits:11',
        ];
        $messages = [
            'username.alpha_num' => '用户名必须是字母加数字！',
            'username.required' => '用户名不能为空！',
            'username.max' => '用户名长度不超过30位！',
            'jobnumber.numeric' =>'工号必须是数字！',
            'jobnumber.required' =>'工号不能为空！',
            'jobnumber.max' =>'工号长度不超过6位！',
            'telephone.numeric' =>'电话必须是数字！',
            'telephone.required' =>'电话不能为空！',
            'telephone.digits' =>'电话长度必须是11位！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
        $input = $request->except('_token','role_id','_method');
        $role_id = $request->input('role_id');
        $admin = Admin::find($id);
        $_role_id = $admin->roles()->value('role_id');
        DB::beginTransaction();
        try {
            $admin->roles()->detach();
            $admin->roles()->attach($role_id);
            $admin = $admin->update($input);
            DB::commit();
            $msg = '修改管理员成功！';
        }
        catch(Exception $e) {
            DB::rollBack();
            $msg = '修改管理员失败，请稍后再试...';
        }
        return back()->with('msg',$msg);
    }
    // delete.admin.destroy用户删除
    public function destroy($id)
    {
        $admin = Admin::find($id);
        DB::beginTransaction();
        try {
            $admin->roles()->detach();
            $admin->where('id',$id)->delete();
            DB::commit();
            $data = [
                'status' => 0,
                'msg' => '删除管理员成功！'
            ];
        }
        catch(Exception $e) {
            DB::rollBack();
            $data = [
                'status' => 1,
                'msg' => '删除管理员失败，请稍后重试...'
            ];
        }
        return $data;
    }
}
