@extends('default')

@section('contents')
    <div class="container">
        @foreach($prizes as $prize)
            <p>
                奖品:{{ $prize->name }}
            </p>
            {{--<p>--}}
                {{--{!! $prize->description !!}--}}
            {{--</p>--}}
        @endforeach
    </div>


@stop