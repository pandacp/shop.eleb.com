@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <table class="table table-condensed">
            <tr style="background: #8be1ff">
                <td>活动标题</td>
                <td>活动开始时间</td>
                <td>活动结束时间</td>
                <td>开奖时间</td>
                <td>活动详情</td>
            </tr>

            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ date('Y-m-d',$event->signup_start) }}</td>
                    <td>{{ date('Y-m-d',$event->signup_end) }}</td>
                    <td>{{ $event->prize_date }}</td>
                    {{--<td>{{ $event->is_prize }}</td>--}}
                    <td>
                        <a href="{{ route('events.show',[$event]) }}" class="glyphicon glyphicon-eye-open"></a>&emsp;
                        {{--<a href="{{ route('events.store',[$event]) }}">报名</a>--}}
                    </td>
                </tr>
            @endforeach
        </table>
        {{--{{ $events->links() }}--}}
    </div>

@stop