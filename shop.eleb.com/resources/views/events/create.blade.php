@extends('default')

@section('contents')
    @include('_error')
    <div class="container" style="width:700px">
        <form action="{{ route('events.store') }}" method="post" >
            <div class="form-group">
                <label for="exampleInputEmail1">请选择需要报名的活动</label>
                <select name="events_id" id="">
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">添加</button>
        </form>
    </div>

@stop

