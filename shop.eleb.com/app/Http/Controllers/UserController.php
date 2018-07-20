<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shop_category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function check(){
        $this->middleware([
            'except'=>['index']
        ]);
    }
    public function index()
    {
        if(Auth::check()){
            $users = User::paginate(5);
            return view('users/route',compact('users'));
        }
        return redirect()->route('login')->with('danger','请登录');
    }

    public function create()
    {
        $shops = Shop::all();
        return view('users/create',compact('shops'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'password'=>'required',
            'email'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'name.max'=>'用户名不能超过10位',
            'password.required'=>'密码不能为空',
            'email.required'=>'邮箱不能为空',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'status'=>$request->status,
            'shop_id'=>$request->shop_id,
        ]);
        $id = $user->id;
//        var_dump($user->id);die;
        return redirect()->route('shops.create')->with('success','添加成功');
    }

    public function edit(User $user)
    {
        $user = Auth::user();
        $shops = Shop::all();
        return view('users/edit',compact('shops','user'));
    }
    public function update(User $user,Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:10',
            'email'=>'required',
            'shop_id'=>'required',
        ],[
            'name.required'=>'用户名不能为空',
            'name.max'=>'用户名不能超过10位',
            'email.required'=>'邮箱不能为空',
        ]);
        $status = 1;
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'shop_id'=>$request->shop_id,
            'status'=>$status,
        ]);
        return redirect()->route('users.index')->with('success','修改成功');
    }
    //修改密码
    public function form()
    {
        $user = Auth::user();
        return view('users/reset',compact('user'));
    }
    public function reset(User $user,Request $request)
    {
        //重置密码,利用哈希
//        var_dump($request->repassword);
        $request->user()->fill([
            'password' => Hash::make($request->repassword)
        ])->save();

        return redirect()->route('users.index')->with('success','修改密码成功');
    }
}
