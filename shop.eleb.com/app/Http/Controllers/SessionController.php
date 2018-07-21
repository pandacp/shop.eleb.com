<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //
    public function login(User $user)
    {
        return view('sessions/login',compact('user'));
    }

    public function store(User $user,Request $request)
    {

        //商家信息为过审,商加账号的不可以使用
//        $user = User::where('name',$request->name)->get();
//        $shop_id = '';
//        foreach ($user as $u){
//            $shop_id=$u->shop_id;
//        }
//        $shops = Shop::where('id',$shop_id)->get();
//        $status = '';
//        foreach ($shops as $shop){
//            $status = $shop->status;
//        }
//        if($status!=1){
//            return back()->with('danger','商户为通过审核,不能使用该账号');
//        }
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'captcha|required',
        ],[
            'name.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码错误',
        ]);
        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password,
        ],$request->rememberToken)){
            //账号状态验证
            $status = Auth::user()->status;
            if($status!=1){
                Auth::logout();//清除session中的数据
                return back()->with('danger','账号状态异常,不能使用该账号');
            }
            //商户状态验证
            $id = Auth::user()->shop_id;
            $shops = Shop::where('id',$id)->get();
            $status = '';
            foreach ($shops as $shop){
                $status = $shop->status;
            }
            if($status!=1){
                Auth::logout();//清除session中的数据
                return back()->with('danger','商户为通过审核,不能使用该账号');
            }
            return redirect()->route('users.index')->with('success','登录成功');
        }else{
            return back()->with('danger','用户名或密码错误');
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login')->with('success','注销成功');
    }
}
