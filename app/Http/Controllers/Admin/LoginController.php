<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Code;
use App\Http\Models\Admin;

class LoginController extends Controller
{
    /**
     * [login description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->all()) {

                $code = new Code();
                $_code = $code->getCode();
                $verify = strtolower($request->input('verify'));

                if ($verify == $_code) {
                    $username = $request->input('username');
                    $admin_id = Admin::where('username',$username)->value('id');
                    if ($admin_id) {
                        $password = Admin::where('username',$username)->value('password');
                        if ($request->input('password') == $password) {
                            $request->session()->put('admin_id', $admin_id);
                            $request->session()->put('admin_name',$username);
                            return redirect()->action('Admin\IndexController@index');
                        } else {
                            return back()->with('msg','密码错误！');
                        }
                    } else {
                        return back()->with('msg','用户名不存在！');
                    }
                } else {
                    return back()->with('msg','验证码错误！');
                }
                
            } else {
                return back()->with('msg','输入不能为空！');  
            }
        } else {
            return view('admin/login');
        }
        
    }
    public function verify()
    {
        $code = new Code();
        $verify = $code->make();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_name');
        return redirect()->route('admin.login');
    }
}