<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    //
    public function check(){
        $this->middleware([
            'except'=>['index']
        ]);
    }
    public function index()
    {
        if(Auth::check()){
            return view('shops/list');
        }
        return redirect()->route('login')->with('danger','请登录');
    }

    public function create()
    {
        $shop_categories = Shop_category::all();
        return view('shops/create',compact('shop_categories'));
    }
    public function store(Request $request)
    {
        $file=$request->shop_img;
//        $this->validate($request,[
//
//        ]);
        $rating = 0;
        $filename = $file->store('public/dp_img');
        Shop::create([
            'shop_name'=>$request->shop_name,
            'shop_img'=>$filename,
            'rating'=>$rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'shop_category_id'=>$request->shop_category_id,
            'status'=>$request->status,
        ]);
//        'shop_category_id','shop_name','shop_img','rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'
        return redirect()->route('users.index')->with('success','添加成功');

    }

}
