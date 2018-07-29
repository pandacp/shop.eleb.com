@extends('default')

@section('contents')
    @include('_error')
    <div class="container">

        <table class="table table-responsive">
            <tr>
                <td>订单id</td>
                <td>订单总价</td>
                <td>用户id</td>
                <td>商家id</td>
                <td>订单编号</td>
                <td>用户手机号码</td>
                <td>用户名</td>
                <td>订单地址</td>
                <td>订单状态</td>
            </tr>
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->shop_id }}</td>
                <td>{{ $order->sn }}</td>
                <td>{{ $order->tel }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->province.$order->city.$order->county.$order->address }}</td>
                <td>@if($order->status==-1)已取消@elseif($order->status==0)待支付@elseif($order->status==1)待发货@elseif($order->status==2)待确认@elseif($order->status==3)完成@endif</td>
            </tr>
        </table>
        <form action="{{ route('orders.update',[$order]) }}" method="post">
            <button type="submit" class="btn btn-primary"><input type="hidden" name="status" value="1">发货</button>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
        </form>
        <br>
        <form action="{{ route('orders.update',[$order]) }}" method="post">
            <button type="submit" class="btn btn-danger"><input type="hidden" name="status" value="-1">取消订单</button>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
        </form>
    </div>

@stop