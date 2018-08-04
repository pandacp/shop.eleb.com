<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function check()
    {
        $this->middleware([
            'except' => ['index']
        ]);
    }

    public function index(Request $request)
    {
        if (Auth::check()) {

            if (!empty($request->year)) {

                $year = $request->year . '-1-1 00:00:00';//开始年份
                $end_year = $request->year . '-12-31 23:59:59';//结束年份
//                var_dump($end_year);
                $count = DB::table('orders')->whereBetween('created_at', [$year, $end_year])->count();

                $name="{$request->year}总订单量";
                return view('orders/count_year', compact('count','name'));

            } elseif (!empty($request->month)) {
                $year = date('Y', time());//获取当前时间的年份
                $month = $year . '-' . $request->month . '-1 00:00:00';//开始月份
                $end_month = $year . '-' . $request->month . '-31 23:59:59';//结束月份
                //根据月份查询订单数量
                $count = DB::table('orders')->whereBetween('created_at', [$month, $end_month])->count();
                $name="{$request->month}月总订单";
                return view('orders/date', compact('count','name'));
            } elseif (!empty($request->day)) {
                $day = $request->day.' 00:00:00';
                $end_day = $request->day.' 23:59:59';
                $count = DB::table('orders')->whereBetween('created_at', [$day, $end_day])->count();

                $name="{$request->day}号总订单";
                return view('orders/date', compact('count','name'));

            } else {
                $orders = Order::all();
            }

            return view('orders/index', compact('orders'));
        }
        return redirect()->route('login')->with('danger', '请登录');
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Order $order, Request $request)
    {
//        var_dump($request->status);die;
        if ($request->status == -1) {
            $order->update([
                'status' => -1,
            ]);
            return redirect()->route('orders.index')->with('danger','取消订单');

        } elseif ($request->status == 1) {
            $order->update([
                'status' => 2,
            ]);
            return redirect()->route('orders.index')->with('success','发货成功');
        }
    }


}
