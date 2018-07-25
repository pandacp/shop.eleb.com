<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menu_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    //使用中间件指定可以访问的页面
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index']
        ]);
    }
    public function index(){
        if(Auth::check()){
            $menu_categories=Menu_category::all();
            $menus = Menu::paginate(5);//paginate(5);
            return view('menus/index',compact('menus','menu_categories'));
        }
        return redirect()->route('login')->with('danger','请登录');
    }
    //添加菜品
    public function create()
    {
        $menu_categories=Menu_category::all();
        return view('menus/create',compact('menu_categories'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'goods_name'=>'required|unique:menus',
            'goods_img'=>'required',
            'goods_price'=>'required',
            'description'=>'required',
            'tips'=>'required',
        ],[
            'goods_name.required'=>'菜品名不能为空',
            'goods_name.unique'=>'菜品名重复',
            'goods_img.required'=>'菜品图片不能为空',
            'goods_price.required'=>'价格不能为空',
            'description.required'=>'描述不能为空',
            'tips.required'=>'提示信息不能为空',
        ]);
        $file = $request->goods_img;
//        $filename= $file->store('public/menus');
        $shop_id = Auth::user()->shop_id;//所属商家ID(当前商家)
        $rating = 0;//评分
        $month_sales = 0;//月销量
        $rating_count = 0;//频分数量
        $satisfy_count = 0;//满意度数量
        $satisfy_rate = 0;//满意度评分
        Menu::create([
            'goods_name'=>$request->goods_name,
            'goods_img'=>$file,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'shop_id'=>$shop_id,
            'category_id'=>$request->category_id,
            'rating'=>$rating,
            'month_sales'=>$month_sales,
            'rating_count'=>$rating_count,
            'satisfy_count'=>$satisfy_count,
            'satisfy_rate'=>$satisfy_rate,
        ]);
        return redirect()->route('menus.index')->with('success','添加成功');
    }

    public function edit(Menu $menu)
    {
        $menu_categories=Menu_category::all();
        return view('menus/edit',compact('menu','menu_categories'));
    }

    public function update(Menu $menu,Request $request)
    {
        $this->validate($request,[
            'goods_name'=>[
                'required',
                Rule::unique('menus')->ignore($menu->id),
            ],
            'goods_price'=>'required',
            'description'=>'required',
            'tips'=>'required',
        ],[
            'goods_name.required'=>'菜品名不能为空',
            'goods_name.unique'=>'菜品名重复',
            'goods_price.required'=>'价格不能为空',
            'description.required'=>'描述不能为空',
            'tips.required'=>'提示信息不能为空',
        ]);
        $file= $request->goods_img;
        $data=[
            'goods_name'=>$request->goods_name,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'category_id'=>$request->category_id,
        ];
        if($file){
//            $filename= $file->store('public/menus');
            $data['goods_img']=$file;
        }
        $menu->update($data);
        return redirect()->route('menus.index')->with('success','修改成功');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')->with('success','删除成功');
    }
}
