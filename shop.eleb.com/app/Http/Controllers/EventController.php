<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Event_member;
use App\Models\Event_prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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

        //2.同一个活动不能报名两次
        $counts = DB::table('event_members')->where([['member_id',Auth::user()->id],['events_id',$request->events_id]])->get();
        //mb_convert_encoding()
        if($counts->isNotEmpty()){
            return back()->with('danger','您已经报过名了');
        }

        //1.报名人数限制
        $event = Event::where('id',$request->events_id)->first();//限制人数
//        $members = Event_member::where('events_id',$request->events_id)->count();//已报名人数
//        if($members==$event->signup_num){
//            return back()->with('danger','该活动报名人数已满,欢迎下次再来');
//        }
        //优化.使用redis解决报名超过问题

        $total = Redis::incr('total_'.$event->id);//报名人数先自增1
        //判断如果报名人数已满,说明之前就已经等于限制人数了,再自减1
        if($total>$event->signup_num){
            Redis::decr('total_'.$event->id);
            return back()->with('danger','该活动报名人数已满,欢迎下次再来');
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

    public function show(Event $event)
    {
        return view('events/show',compact('event'));
    }

}
