<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        //$time = date('Y-m-d H:i:s',time());
        //$activities = Activity::where('end_time','>',$time)->paginate(5);
        //return view('activities/index',compact('activities'));
//页面静态化  优化
        $activities = Activity::paginate(5);
        $contents = view('activities/index',compact('activities'));
        file_put_contents('activities.html',$contents);
//        return file_get_contents('activities.html');
    }

    public function show(Activity $activity)
    {
//        $activities = Activity::find($activity);
//        return view('activities/show',compact('activities'));
        //优化  内容页面静态化
        $activities = Activity::find($activity);
        $contents = view('activities/show',compact('activities'));

        file_put_contents("activities_show{$activity->id}.html",$contents);
        return file_get_contents("activities_show{$activity->id}.html");
    }
}
