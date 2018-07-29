@extends('default')

@section('contents')
    <div class="container" style="text-align: center">
        <table class="table table-bordered">
            <tr>
                <td>菜名</td>
                <td>总销量</td>
            </tr>
            <tr>
                <td>{{ $name }}</td>
                <td>{{ $amount }}</td>
            </tr>
        </table>
        <a href="{{ route('orders.index') }}"><span style="font-size: 30px">返回</span></a>
    </div>
@stop