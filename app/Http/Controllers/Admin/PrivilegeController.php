<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Privilege;
use Illuminate\Support\Facades\DB;

class PrivilegeController extends Controller
{
	// get.pri.index列表页
     public function index()
    {
    	$pris = Privilege::all();
    	return view('admin.privilege.lst')->with('data',$pris);
    }
    // get.pri.create添加页
    public function create()
    {
    	return view('admin.privilege.add');
    }
    // ajax返回顶级权限
    public function getTopPris(Request $request)
    {
      $data = Privilege::where('pid','0')->select('id','pri_name')->get()->toArray();
      // dd($data);
      return $data;
    }
    // post.pri.store添加权限
    public function store(Request $request)
    {
        $rules = [
          'pri_name' => 'bail|required|max:10|unique:privilege',
          'pri_route' => 'required',
        ];
        $messages = [
          'pri_name.required' => '权限名称不能为空！',
          'pri_name.max' => '权限名称不能超过10个字符',
          'pri_name.unique' => '权限名称已存在！',
          'pri_route.required' => '权限路由不能为空！',
        ];
        $validateData = $this->validate($request,$rules,$messages);
    	$is_top = $request->input('is_top');
      if ($is_top = 1) {
        $input = array_add($request->except('_token','is_top'),'pid','0');
      } else {
        $input = $request->except('_token','is_top');
      }
      // dd($input);
    	$pri = Privilege::create($input);
    	if ($pri) {
    		return redirect()->action('Admin\PrivilegeController@index')->with('msg','添加权限成功！');
    	} else {
    		return back()->with('msg','添加权限失败，请稍后重试...');
    	}
    }
    // get.pri.show单个权限信息
    public function show($id)
    {
    	
    }
    
    // get.pri.edit修改页面
    public function edit($id)
    {
    	$pri = Privilege::find($id);
      switch ($pri->pid) {
        case '0':
          $pri->is_top = 1;
          $data['pri'] = $pri;
          break;
        
        default:
          $pri->is_top = 0;
          $top_pris = Privilege::where('pid','0')->select('id','pri_name')->get();
          $data = array('pri' => $pri ,'top_pris' => $top_pris );
          break;
      }
      // dd($data);
    	return view('admin.privilege.edit')->with('data',$data);
    }
    // put.pri.update权限更新
    public function update($id,Request $request)
    {
      $rules = [
        'pri_name' => 'bail|required|max:10',
        'pri_route' => 'required',
      ];
      $messages = [
        'pri_name.required' => '权限名称不能为空！',
        'pri_name.max' => '权限名称不能超过10个字符',
        'pri_route.required' => '权限路由不能为空！',
      ];
      $validateData = $this->validate($request,$rules,$messages);
      $is_top = $request->input('is_top');
      if ($is_top = 1) {
        $input = array_add($request->except('_method','_token','is_top'),'pid','0');
      } else {
        $input = $request->except('_method','_token','is_top');
      }
      // dd($input);
    	$pri = Privilege::find($id);
    	if($pri->update($input)){
    		$msg = '修改权限成功！';
    	} else {
    		$msg = '修改权限失败，请稍后重试...';
    	}
    	return back()->with('msg',$msg);
    }
    // delete.pri.destroy权限删除
    public function destroy($id)
    {
    	$pri = Privilege::find($id);
      $role_id = DB::table('role_pri')->where('pri_id',$pri->id)->value('role_id');
      $role_name = DB::table('role')->where('id',$role_id)->value('role_name');
      if ($role_id == null) {
        $cpris = Privilege::where('pid',$role->id)->value('id');
        if ($cpris == null) {
          if ($pri->delete()) {
            $data = [
              'status' => 0,
              'msg'    => '权限删除成功！'
            ];
          } else {
            $data = [
              'status' => 1,
              'msg'    => '权限删除失败！'
            ];  
          }
        } else {
          $data = [
            'status' => 2,
            'msg'    => '权限删除失败,请先删除这个权限的子权限'
          ];  
        }
      } else {
        $data = [
          'status' => 3,
          'msg'    => '权限删除失败，请先取消'.$role_name.'的这个权限'
        ];
      } 
    	return $data; 
    }
}