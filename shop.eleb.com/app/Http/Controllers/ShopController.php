<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop_category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Mockery\Exception;

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
        $shops = Shop::all();
        return view('shops/create',compact('shop_categories','shops'));
    }
    public function store(Request $request)
    {

        $user = Auth::user()->id;//当前用户id
        $this->validate($request,[
            'shop_name'=>'required|max:10',
            'shop_img'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',

            'name'=>'required|max:10',
            'password'=>'required',
            'email'=>[
                'required',
                Rule::unique('users')->ignore($user),
            ],
        ],[
            'shop_name.required'=>'商店名称不能为空',
            'shop_name.max.required'=>'商店名称不能大于10位',
            'shop_img.required'=>'商店名称不能大于10位',
            'start_send.required'=>'起送金额不能为空',
            'send_cost.required'=>'配送费不能为空',

            'name.required'=>'用户名不能为空',
            'name.max'=>'用户名不能超过10位',
            'password.required'=>'密码不能为空',
            'email.required'=>'邮箱不能为空',
            'email.unique'=>'邮箱被使用',
        ]);


        DB::beginTransaction();
        try{
            //添加商户信息
            $file=$request->shop_img;
            $rating = 0;
            $filename = $file->store('public/dp_img');
            $result = Shop::create([
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
            if(!$result){
                throw new \Exception(1);
            }
            //添加用户
            $result2 = User::create([
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                'status'=>$request->status,
                'shop_id'=>$request->shop_id,
            ]);
            if(!$result2){
                throw new \Exception(2);
            }
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();//事务回滚
            echo $e->getMessage();
            echo $e->getCode();
        };
//        $file=$request->shop_img;
//        $rating = 0;
//        $filename = $file->store('public/dp_img');
//        $result = Shop::create([
//            'shop_name'=>$request->shop_name,
//            'shop_img'=>$filename,
//            'rating'=>$rating,
//            'brand'=>$request->brand,
//            'on_time'=>$request->on_time,
//            'fengniao'=>$request->fengniao,
//            'bao'=>$request->bao,
//            'piao'=>$request->piao,
//            'zhun'=>$request->zhun,
//            'start_send'=>$request->start_send,
//            'send_cost'=>$request->send_cost,
//            'notice'=>$request->notice,
//            'discount'=>$request->discount,
//            'shop_category_id'=>$request->shop_category_id,
//            'status'=>$request->status,
//        ]);
//        'shop_category_id','shop_name','shop_img','rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status'
        return redirect()->route('shops.index')->with('success','添加成功');

    }

}
