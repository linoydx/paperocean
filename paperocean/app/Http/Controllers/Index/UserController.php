<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Index\CommenController;
use Illuminate\Support\Facades\DB;

class UserController extends CommenController
{
	public function index($id) {
		$data = DB::table('user')->where('id',$id)->select('username','telephone')->first();
		$data->id = $id;
		// dd($data);
		return view('index.userinfo')->with('data',$data);
	}
	/**
	 * 显示用户信息
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function show($id) {
		$data = DB::table('user')->where('id',$id)->value('username','nickname');
		// dd($data);
		return view('index.user')->with('data',$data);
	}
	/**
	 * 用户更新页面
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function edit($id) {
		$data = DB::table('user')->where('id',$id)->first();
		return view('index.user.edit')->with('data',$data);
	}
	/**
	 * 用户更新提交
	 * @param  [type]  $id      [description]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function update($id,Request $request)
	{
		if ($request->isMethod('post')) {
			$input = $request->except('_token');
			if ($input) {
				$res = DB::table('user')->where('id', $id)->update([
					'nickname'  => $request->input('nickname'),
					'telephone' => $request->input('telephone')
				]);
				if ($res){
					return view('index.user');
				} else {
					return back()->with('msg','保存失败，请稍后再试...');
				}
			} else {
				return back()->with('msg','请补充资料...');
			}
		}
	}
	public function pass() {
	}
	/**
	 * 检查用户名是否存在
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function checkUser(Request $request) {
		$input = $request->except('_token');
		if ($input) {
			$user_id = DB::table('user')->where('username',$request->input('username'))->value('id');
			if ($user_id) {
				$data = 1;
			} else {
				$data = 0;
			}
		} else {
			return false;
		}
		return $data;
	}
}