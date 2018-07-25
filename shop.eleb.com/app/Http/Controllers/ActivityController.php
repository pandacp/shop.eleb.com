<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $time = date('Y-m-d H:i:s',time());

        $activities = Activity::where('end_time','>',$time)->paginate(5);
        return view('activities/index',compact('activities'));
    }

    public function show(Activity $activity)
    {

        $activities = Activity::find($activity);
//        var_dump($activities);
        return view('activities/show',compact('activities'));
    }
}
