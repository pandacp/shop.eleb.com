@extends('default')

@section('contents')
    @include('_error')
    <div class="container">

        <form class="navbar-form navbar-left" action="{{ route('orders.index') }}" method="post">
            <div class="form-group">
                年:<select name="year" >
                    <option value=""></option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                </select>
                月:<select name="month" >
                    <?php for($i=0;$i<=12;$i++):?>
                        <option value="{{ $i }}">{{ $i }}</option>
                    <?php endfor;?>
                </select>
                天:<input type="date" name="day" class="form-control" placeholder="2018-12-31" value="{{ old('to_year') }}">
            </div>
            {{ csrf_field() }}
            {{ method_field('GET') }}
            <button type="submit" class="btn btn-default">统计</button>
        </form>

        <table class="table table-bordered">
            <tr>
                <td>订单id</td>
                <td>订单编号</td>
                <td>订单生成日期</td>
                <td>订单状态</td>
                <td>操作</td>
            </tr>
            <?php foreach($orders as $order):?>
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->sn }}</td>
                <td>{{ $order->created_at }}</td>
                <td>@if($order->status==-1)<span style="color:red">已取消</span> @elseif($order->status==0)待支付@elseif($order->status==1)待发货@elseif($order->status==2)<span style="color:blue">待确认</span>@elseif($order->status==3)完成@endif</td>
                <td>
                    <a href="{{ route('orders.edit',[$order]) }}">订单详情</a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>


@stop