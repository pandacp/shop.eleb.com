@extends('default')

@section('contents')
    <div class="container" style="text-align: center">
        <h1>{{ $name }}</h1>
        <h2>{{ $count }}</h2>
        <a href="{{ route('orders.index') }}"><span style="font-size: 30px">返回</span></a>
    </div>
@stop