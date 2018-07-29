@extends('default')

@section('contents')
    <div class="container" style="text-align: center">
        <table class="table table-bordered">
            <tr>
                <td><h2>{{ $name }}</h2></td>
            </tr>
            <tr>
                <td><span style="font-size: 30px">{{ $count }}</span></td>
            </tr>
        </table>
        <a href="{{ route('orders.index') }}"><span style="font-size: 30px">返回</span></a>
    </div>
@stop