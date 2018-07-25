@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <table class="table table-condensed">
            {{--<tr style="background: #8be1ff">--}}
                {{--<td>活动标题</td>--}}
                {{--<td>活动开始时间</td>--}}
                {{--<td>活动结束时间</td>--}}
            {{--</tr>--}}

            @foreach($activities as $activity)

                <h1 style="text-align: center;color: red">{{ $activity->title }}</h1>
                <p style="text-align: center"><span>开始时间</span>:{{ $activity->start_time }}</p>
                <p style="text-align: center"><span style="color: red">结束时间</span>:{{ $activity->end_time }}</p>
                <p style="text-align: center">{!! $activity->content !!}</p>


            @endforeach
        </table>
    </div>

@stop