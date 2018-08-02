<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //抽奖活动列表
    public function index()
    {
        $events = Event::where('signup_end','>',time())->get();
        return view('events/index',compact('events'));
    }
    //活动报名
    public function create()
    {
        //查询所有活动
        $events = Event::where('signup_end','>',time())->get();
        return view('events/create',compact('events'));
    }

    public function store(Request $request)
    {
        //同一个活动不能报名两次
        
//        $count = DB::table('event_members')->where('events_id',$request->events_id)->count();
        $counts = DB::table('event_members')->where([['member_id',Auth::user()->id],['events_id',$request->events_id]])->get();

        if($counts->isNotEmpty()){
            return back()->with('danger','您已经报过名了');
        }
        Event_member::create([
            'events_id'=>$request->events_id,
            'member_id'=>Auth::user()->id,
        ]);
        return redirect()->route('events.index')->with('success','报名成功');
    }
    //抽奖结果查询
    public function check()
    {
        $prizes = Event_prize::where('member_id',Auth::user()->id)->get();
//        var_dump($prizes);die;
        return view('events/list',compact('prizes'));
    }


}
