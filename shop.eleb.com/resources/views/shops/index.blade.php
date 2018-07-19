@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <table class="table table-condensed">
            <tr style="background: #9dcbff">
                <td>店铺名称</td>
                <td>店铺图片</td>
                <td>店铺分类ID</td>
                <td>评分</td>
                <td>审核状态</td>
                <td>操作</td>
            </tr>
            @foreach($shops as $shop)
            <tr>
                <td>{{ $shop->shop_name }}</td>
                <td><img src="{{ \Illuminate\Support\Facades\Storage::url($shop->shop_img) }}" alt="" style="width:100px"></td>
                <td>{{ $shop->Shop_category->name }}</td>
                <td>{{ $shop->rating }}</td>
                <td>{{ $shop->status }}</td>
                <td>
                    <a href="{{ route('shops.edit',[$shop]) }}"><button class="btn btn-primary">修改</button></a>
                    <form action="{{ route('shops.destroy',[$shop]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    {{ $shops->links() }}
    </div>
@stop