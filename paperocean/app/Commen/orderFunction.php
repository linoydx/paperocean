<?php
use Illuminate\Support\Facades\DB;

/** 
 * 计算订单总价
 * @param  [type] $order_id 订单id
 * @return [type] $pay_total   订单金额
 */   
function calculatePay($order_id) {
    $book_costs = DB::table('order_book')->where('order_id',$order_id)->select('order_book_cost')->get();
    // 订单图书总价
    static $book_totals = 0;
    bcscale(2);
    foreach ($book_costs as $value) {
        $book_totals = bcadd($book_totals, $value->order_book_cost);
    }
    // 订单运费
    $post_cost = DB::table('order')->where('id',$order_id)->value('post_cost');
    // 订单总价
    $pay_total = bcadd($book_totals, $post_cost);
    return $pay_total;
}