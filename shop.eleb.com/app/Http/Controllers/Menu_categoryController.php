<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menu_category;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Menu_categoryController extends Controller
{
    //使用中间件指定可以访问的页面
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index','show']
        ]);
    }

    public function show(Request $request)
    {
        $goods_name = $request->goods_name;
        $goods_price = $request->goods_price;
        $goods_price2 = $request->goods_price2;

        $keyword = $request->keyword;
        if($keyword){
//            $homes = Article::where('category_id','like',"{$keyword}")->paginate(3);
            $menus = Menu::where('category_id',"{$keyword}")->paginate(5);
        }elseif($goods_price){
            $menus = Menu::whereBetween('goods_price',[$goods_price,$goods_price2])->paginate(3);

        }elseif($goods_name){
            $menus = Menu::where('goods_name','like',"%{$goods_name}%")->paginate(1);

        }else{
            $menus = Menu::paginate(1);
        }
        $menu_categories = Menu_category::all();//菜品分类
        return view('menu_categories/show',compact('menu_categories','menus','keyword','goods_name','goods_price','goods_price2'));
    }
    //菜单分类列表
    public function index(Menu_category $menu_category)
    {
        if(Auth::check()){
            $shop_id = Auth::user()->shop_id;//当前用户的ID
            $menu_categories=Menu_category::where('shop_id',$shop_id)->paginate(5);
//            $menu_categories=Menu_category::paginate(5);
            return view('menu_categories/index',compact('menu_categories'));
        }
        return redirect()->route('login')->with('danger','请登录');
    }

    public function create(Menu_category $menu_category,Shop $shop)
    {
//        $shops = Shop::all();
        return view('menu_categories/create',compact('menu_category'));
    }

    public function store(Menu_category $menu_category,Request $request)
    {
        $this->validate($request,[
            'name'=>[
                'required',
//                Rule::unique('menu_categories'),
            ],
            'description'=>'required',
        ],[
            'name.required'=>'分类名称不能为空',
//            'name.unique'=>'分类名称重复',
            'description.required'=>'描述不能为空',
        ]);
        //有且只有一个默认菜品分类
        //根据当前分类的is_selected字段,查询出是否有值为1数据
        $rss = Menu_category::where('is_selected',1)->get();
        if($rss){//如果有,修改为将其0
            //如果该分类设置为了默认,取消其他的默认
            if($request->is_selected==1){
                foreach ($rss as $rs){
                    $rs->update([
                        'is_selected'=>0
                    ]);
                }
            }
        }
        $str = 'abcdefghijkmnpqrstuvwxy';
        $str =str_shuffle($str);
        $radon_str = substr($str,0,5);

        $shop_id = Auth::user()->shop_id;
        Menu_category::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'shop_id'=>$shop_id,
            'is_selected'=>$request->is_selected,
            'type_accumulation'=>$radon_str,
        ]);
        return redirect()->route('menu_categories.index')->with('success','添加分类成功');
    }
    //修改表单
    public function edit(Menu_category $menu_category,Request $request)
    {
        return view('menu_categories/edit',compact('menu_category'));
    }
    //保存
    public function update(Menu_category $menu_category,Request $request)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('menu_categories')->ignore($menu_category->id),
            ],
            'description'=>'required',
        ],[
            'name.required'=>'分类名称不能为空',
            'name.unique'=>'分类名称重复',
            'description.required'=>'描述不能为空',
        ]);
        $rss = Menu_category::where('is_selected',1)->get();//查询出是否有值为1数据
        if($rss){//如果有,修改为将其0
            //如果该分类设置为了默认,取消其他的默认
            if($request->is_selected==1){
                foreach ($rss as $rs){
                    $rs->update([
                        'is_selected'=>0
                    ]);
                }
            }
        }
        $menu_category->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
        ]);
        return redirect()->route('menu_categories.index')->with('success','修改分类成功');
    }

    public function destroy(Menu_category $menu_category)
    {
        $category_id = $menu_category->id;//当前分类的id
        $menu = Menu::where('category_id',$category_id)->get();//根据id查找到其下是否有菜品,有不能删除
//        var_dump($menu);die;
        if(!$menu->isEmpty()){
            return back()->with('danger','当前分类下有菜品,不能删除');
        }
        $menu_category->delete();
        return redirect()->route('menu_categories.index')->with('success','删除分类成功');
    }
}
