<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Index\CommenController;
use Illuminate\Support\Facades\DB;

class LoginController extends CommenController
{

    /**
     * 用户注册
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function regist(Request $request) {
        if ($request->isMethod('post')) {
            $rules = [
                'username' => 'bail|required|alpha_num|max:30|unique:user',
                'password' => 'required|between:6,20|confirmed',
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
                'telephone.numeric' =>'电话必须是数字！',
                'telephone.required' =>'电话不能为空！',
                'telephone.digits' =>'电话长度必须是11位！',
            ];
            $validateData = $this->validate($request,$rules,$messages);
            $user_id = DB::table('user')->insertGetId([
                'username' => $request->input('username'),
                'nickname' => $request->input('username').'122',
                'password' => $request->input('password'),
                'telephone' => $request->input('telephone'),
                'create_time' => time()
            ]);
            if ($user_id) {
                return view('index.index');
            } else {
                return back()->with($request->input());
            }   
        } else {
            return view('index.regist');
        }
    }
    /**
     * 用户登录
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->input()) {
                $username = $request->input('username');
                $user = DB::table('user')->where('username',$username)->first();
                if ($user) {
                    if ($request->input('password') == $user->password) {                     $request->session()->put('username', $user->username);
                        $request->session()->put('user_id', $user->id);
                        return back();
                    } else {
                        return back()->with('msg','密码错误！');
                    }
                } else {
                    return back()->with('msg','用户名不存在！');
                }
            } else {
                return back()->with('msg','输入不能为空！');  
            }
        }
        return back();
    }
    /**
     * 用户退出登录
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function logout(Request $request)
    {
        $request->session()->forget('username');
        $request->session()->forget('user_id');
        return back();
    }
}
