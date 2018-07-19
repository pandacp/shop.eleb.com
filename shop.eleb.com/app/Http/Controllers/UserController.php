<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('users/route',compact('users'));
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

        $rememberToken = 0;
        $user = User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'status'=>$request->status,
            'shop_id'=>$request->shop_id,
            'rememberToken'=>$rememberToken,
        ]);
        $id = $user->id;
//        var_dump($user->id);die;
        return redirect()->route('shops.create')->with('success','添加成功');
    }
}
