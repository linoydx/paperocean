<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Index\CommenController;
use Illuminate\Support\Facades\DB;

class HomeController extends CommenController
{
    /**
     * 显示网站首页
     * @return [type] [description]
     */
    public function index()
    {
        return view('index.index');
    }

    /**
     * 搜索相关图书
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function search(Request $request)
    {
    	// $search = strip_tags(htmlspecialchars($request->input('search')));
    	// $data = DB::table('book')->where('book_name','like',$search.'%')->limit(10)->get();
    	return view('index.books');
    }
    /**
     * 个人中心
     * @return [type] [description]
     */
    public function person($id) {
        // 取出用户信息
        $data['user'] = DB::table('user')->where('id',$id)->value('username','nickname');
        // 取出用户进行中的订单
        // $unfinished_orders = DB::table('order')->where([
        //     ['user_id','=',$id],
        //     ['finished','=',0]
        // ])->select('id','pay_status','post_status','has_comment')->get();
        // // dd($unfinished_orders);
        // foreach ($unfinished_orders as $order) {

        //     if ($order->pay_status == 0) {
        //         // 筛选出未支付的订单
        //         $nopayment[] = $order; 
        //     } else {
        //         if ($order->post_status == 0) {
        //             // 已支付未发货的订单
        //             $unshipped[] = $order;
        //         } elseif ($order->post_status == 3) {
        //             // 未评论订单
        //             $nocomment[] = $order;
        //         } else {
        //             // 运送中的订单
        //             $posting[] = $order;
        //         }
        //     }  
        // }
        // // 计算每种情况的总数填充数组
        // $data['num'] = array(
        //     'nopayment' => count($nopayment),
        //     'unshipped' => count($unshipped),
        //     'posting'   => count($posting),
        //     'nocomment' => count($nocomment)
        // );
        return view('index.person')->with('data',$data);
    }
}