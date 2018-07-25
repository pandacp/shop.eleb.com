@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <table class="table table-condensed">
            <tr style="background: #8be1ff">
                <td>活动标题</td>
                <td>活动开始时间</td>
                <td>活动结束时间</td>
                <td>操作</td>
            </tr>

            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->title }}</td>
                    <td>{{ $activity->start_time }}</td>
                    <td>{{ $activity->end_time }}</td>
                    <td>
                        <a href="{{ route('activities.show',[$activity]) }}" class="glyphicon glyphicon-eye-open"></a>&emsp;
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $activities->links() }}
    </div>

@stop