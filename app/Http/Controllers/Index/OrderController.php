<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Index\CommenController;
use Illuminate\Support\Facades\DB;

class OrderController extends CommenController
{
    // 订单列表
    public function index()
    {
    	$user_id = session('user_id');
    	$orders = DB::table('order')
    				->join('order_book','order.id','=','order_book.order_id')
    				->join('book','order_book.book_id','=','book.id')
                    ->where('user_id',$user_id)
    				->get();
    	dd($orders);
    }
    /**
     * 创建订单
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        // 订单表插入数据
        $order_input = array();
        // 订单图书表插入数据
        $order_book = array();
        // 订单号
        $order_input['order_num'] = date('YmdHis').str_pad(session('user_id'),'5','0',STR_PAD_LEFT);
        // 下单用户id
        $order_input['user_id'] = session('user_id');
        //下单时间
        $order_input['create_time'] = time();
        // 订单图书id
        $order_book['book_id'] = $request->input('book_id');
        // 订单图书数量
        $order_book['order_book_num'] = $request->input('book_number');
        // 计算图书总价
        $order_book['order_book_cost'] = bcmul($request->input('book_price'),(int)$request->input('book_number'),2);
        // 运费
        $order_input['post_cost'] = $request->input('post_cost');
        // 计算订单费用
        $order_input['pay_total'] = bcadd($order_input['post_cost'],$order_book['order_book_cost'],2);
        DB::beginTransaction();
        try {
            // 保存订单拿到订单id
            $order_id = DB::table('order')->insertGetId($order_input);
            $order_book['order_id'] = $order_id;
            // 保存订单图书信息
            DB::table('order_book')->insert($order_book);
            // 保存订单状态
            DB::table('order_status')->insert(['order_id'=>$order_id]);
            DB::commit();
            return redirect()->action('Index\OrderController@edit',['id' => $order_id]);
        }
        catch (Exception $e) {
            DB::rollBack();
            return back();
        }
    }
    /**
     * 订单确认页
     * @param  [type] $id 订单id
     * @return [type]     [description]
     */
    public function edit($id){
        // 获取订单信息
        $data['order'] = DB::table('order')->where('id',$id)->select('id','post_cost','pay_total')->first();
        // 获取订单图书信息
        $data['order_books'] = DB::table('order_book')
            ->join('book','order_book.book_id','=','book.id')
            ->where('order_book.order_id',$id)
            ->select('order_book.book_id','order_book.order_book_num','book.book_title','book.shop_price','order_book.order_book_cost')
            ->get();
        
        // 获取用户收货地址信息
        $user_id = session('user_id');
        $data['post'] = DB::table('user_shipinfo')->where('user_id',$user_id)->get();
        // dd($data);
        return view('index.order')->with('data',$data);
    }
    /**
     * 确认订单提交
     * @param  [type]  $id      订单id
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function update($id,Request $request) {
        if ($request->isMethod('put')) {
            $input = $request->except('_method','_token','pay_total');
            $order_pay_total = DB::table('order')->where('id',$id)->value('pay_total');
            if ($request->input('pay_total') === $order_pay_total) {
                $re = DB::table('order')->where('id',$id)->update($input);
                if ($re) {
                    return '确认成功';
                }
                return back();
            }
            return back();
        }
        return back();
    }
    /**
     * ajax更新某一图书数量总价
     * @param [type]  $id      订单id
     * @param Request $request [description]
     */
    public function setOrderBook($id,Request $request) {
        $input = $request->except('_token');
        $order_id = $id;
        $book_id = $request->input('book_id');
        $book_price = (float)$request->input('book_price');
        $book_num = (int)$request->input('book_num');
        // 图书总价
        $book_cost = $book_price * $book_num;
        $post_cost = DB::table('order')->where('id',$order_id)->value('post_cost');
        DB::beginTransaction();
        try {
            DB::table('order_book')->where([
                ['order_id','=',$order_id],
                ['book_id','=',$book_id]
            ])->update([
            'order_book_num'  => $book_num,
            'order_book_cost' => $book_cost
            ]);
            $pay_total = calculatePay($order_id);
            DB::table('order')->where('id',$order_id)->update(['pay_total' => $pay_total]);
            DB::commit();
            $data = [
                'status'   => 0,
                'book_cost'=> $book_cost,
                'pay_total'=> $pay_total,
            ];
        }
        catch (Exception $e) {
            DB::rollBack();
            $res = DB::table('order_book')->where([
                ['order_id','=',$order_id],
                ['book_id','=',$book_id]
            ])->select('order_book_num','order_book_cost')->first();
            $pay_total = calculatePay($order_id);
            $data = [
                'status'   => 1,
                'book_num' => $res->order_book_num,
                'book_cost'=> $res->order_book_cost,
                'pay_total'=> $pay_total,
            ];
        }
        return $data;
    }
    
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            // 删除id为$id的订单数据
            DB::table('order')->where('id',$id)->delete();
            DB::table('order_book')->where('order_id',$id)->delete();
            DB::table('order_status')->where('order_id',$id)->delete();
            DB::commit();
            $data = [
                'status' => 0,
                'msg' => '删除订单成功！'
            ];
        }
        catch (Exception $e) {
            DB::rollBack();
            $data = [
                'status' => 1,
                'msg' => '删除订单失败，请稍后再试...'
            ];
        }
    }
    // public function test($id)
    // {
    //     $res = DB::table('order')
    //             ->join('order_book','order.id','=','order_book.order_id')
    //             ->join('order_status','order.id','=','order_status.order_id')
    //             ->where('order.id',$id)
    //             ->delete();
    //     dd($res);
    // }
}