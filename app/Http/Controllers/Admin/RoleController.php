<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
	// get.pri.index列表页
     public function index()
    {
    	$roles = Role::select('id','role_name','role_description')->get();
    	// dd($roles);
    	return view('admin.role.lst')->with('data',$roles);
    }
    
    // get.pri.create添加页
    public function create()
    {
      $pris = DB::table('privilege')->select('id','pri_name','pid')->get();
      foreach ($pris as $value) {
        if ($value->pid == 0) {
          foreach ($pris as $value1) {
            if ($value1->pid == $value->id) {
              $value->children[] = $value1;
            }
          }
          $data[] = $value;
        }
      }
    	return view('admin.role.add')->with('data',$data);
    }
    
    // post.pri.store添加角色
    public function store(Request $request)
    {
        $rules = [
          'role_name' => 'bail|required|max:10|unique:role',
        ];
        $messages = [
          'role_name.required' => '角色名称不能为空！',
          'role_name.max' => '角色名称不能超过10个字符',
          'role_name.unique' => '角色名称已存在！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
    	$input = $request->except('_token','role_pri');
      $pri_ids = $request->input('role_pri');
      DB::beginTransaction();
      try{
        $role = Role::create($input);
        foreach ($pri_ids as $pri_id) {
          $role->pris()->attach($pri_id);
        }
        DB::commit();
        return redirect()->action('Admin\RoleController@index')->with('msg','添加角色成功！');
      }
      catch(Exception $e){
        DB::rollBack();
        return back()->with('msg','添加角色失败，请稍后重试...');
      }
    }
    // get.pri.show单个角色信息
    public function show($id)
    {
    	
    }
    // get.pri.edit修改页面
    public function edit($id)
    {
    	$role = Role::find($id);
      $data['role'] = $role;
      $pris = DB::table('privilege')->select('id','pri_name','pid')->get();
      foreach ($pris as $value) {
        if ($value->pid == 0) {
          foreach ($pris as $value1) {
            if ($value1->pid == $value->id) {
              $value->children[] = $value1;
            }
          }
          $data['pris'][] = $value;
        }
      }
      // dd($data);
    	return view('admin.role.edit')->with('data',$data);
    }

    // ajax返回某角色的权限
    public function getRolePris($id)
    {
      $role_pris_id = DB::table('role_pri')->where('role_id',$id)->select('pri_id')->get();
      return $role_pris_id;
    }

    // put.pri.update角色更新
    public function update($id,Request $request)
    {
        $rules = [
          'role_name' => 'bail|required|max:10',
        ];
        $messages = [
          'role_name.required' => '角色名称不能为空！',
          'role_name.max' => '角色名称不能超过10个字符',
        ];
        $validateData = $this->validate($request,$rules,$messages);  
    	$input = $request->except('_method','_token','role_pri');
    	// dd($input);
      $new_pri_ids = $request->input('role_pri');
      DB::beginTransaction();
      try{
        DB::table('role_pri')->where('role_id',$id)->delete();
        $role = Role::find($id);
        $role->update($input);
        foreach ($new_pri_ids as $pri_id) {
          $role->pris()->attach($pri_id);
        }
        DB::commit();
        return back()->with('msg','修改角色成功！');
      }
      catch(Exception $e){
        DB::rollBack();
        return back()->with('msg','修改角色失败，请稍后重试...');
      }
    }
    
    // delete.pri.destroy角色删除
    public function destroy($id)
    {
    	$role = Role::find($id);
      DB::beginTransaction();
      try{
        $role->pris()->detach();
        $role->delete();
        DB::commit();
        $data = [
          'status' => 0,
          'msg'    => '角色删除成功！'
        ];
      }
      catch(Exception $e) {
        DB::rollBack();
          $data = [
            'status' => 1,
            'msg'    => '角色删除失败！'
          ];
      } 
    	return $data; 
    }
}