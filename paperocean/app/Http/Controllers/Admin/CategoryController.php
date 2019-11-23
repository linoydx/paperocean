<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Category;

class CategoryController extends Controller
{
	// get.cate.index列表页
     public function index()
    {
        $cates =new Category();
        $data = $cates->getCates();
        // dd($data);
        return view('admin.category.lst')->with('data',$data);
    }
    
    // get.cate.create添加页
    public function create()
    {
      return view('admin.category.add');
    }
    public function getTopCates()
    {
      $data = Category::where('pid','0')->select('id','cate_name')->get()->toArray();
      return $data;
    }
    // post.cate.store添加
    public function store(Request $request)
    {
      $rules = [
          'cate_name' => 'bail|required|max:8|unique:category',
        ];
      $messages = [
          'cate_name.required' => '分类名称不能为空！',
          'cate_name.max' => '分类名称不能超过8个字符',
          'cate_name.unique' => '分类名称已存在！',
      ];
      $validateData = $this->validate($request,$rules,$messages);
      $is_top = $request->input('is_top');
      if ($is_top = 1) {
        $input = array_add($request->except('_token','is_top'),'pid','0');
      } else {
        $input = $request->except('_token','is_top');
      }
    	$res= Category::create($input);
    	// dd($res);
    	if ($res) {
    		return redirect()->action('Admin\CategoryController@index')->with('msg','添加分类成功！');
    	} else {
    		return back()->with('msg','添加分类失败，请稍后重试...');
    	}
    }
    // get.cate.show查找某个分类的子分类
    public function show($id)
    {
      $data = Category::where('pid',$id)->get()->toArray();
      return $data;
    }
    // get.cate.edit修改页面
    public function edit($id)
    {
      $cate = Category::find($id);
      // dd($cate);
      if ($cate->pid ==0) {
        $cate->is_top = 1;
        $data['cate'] = $cate;
       } else {
        $cate->is_top = 0;
        $top_cates = Category::where('pid','0')->select('id','cate_name')->get();
        $data = array('cate' => $cate ,'top_cates' => $top_cates);
      }
      // dd($data);
      return view('admin.category.edit')->with('data',$data);
    }
    // put.cate.update分类更新
    public function update($id,Request $request)
    {
      $rules = [
        'cate_name' => 'bail|required|max:8',
      ];
      $messages = [
        'cate_name.required' => '分类名称不能为空！',
        'cate_name.max' => '分类名称不能超过8个字符',
      ];
      $validateData = $this->validate($request,$rules,$messages);
      $is_top = $request->input('is_top');
      if ($is_top = 1) {
        $input = array_add($request->except('_method','_token','is_top'),'pid','0');
      } else {
        $input = $request->except('_method','_token','is_top');
      }
      // dd($input);
    	$cate = Category::find($id);
    	if($cate->update($input)){
    		$msg = '修改分类成功！';
    	} else {
    		$msg = '修改分类失败，请稍后重试...';
    	}
    	return back()->with('msg',$msg);
    }
    // delete.cate.destroy分类删除
    public function destroy($id)
    {
     	$cate = Category::find($id);
     	$res = Category::where('pid',$cate->id)->select('id')->get();
     	if ($res == null) {
        if ($cate->delete()) {
          $data = [
            'status' => 0,
            'msg'    => '分类删除成功！'
          ];
        } else {
          $data = [
            'status' => 1,
            'msg'    => '分类删除失败！'
          ];
        }
     	} else {
         $data = [
          'status' => 1,
          'msg'    => '顶级分类，存在下级分类不能删除！'
        ];
      }
    	return $data;   
    }
}
