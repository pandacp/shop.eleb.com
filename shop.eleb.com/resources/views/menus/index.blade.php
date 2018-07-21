@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <table class="table table-condensed">
            <tr style="background: #9dcbff">
                <td>菜品名称</td>
                <td>菜品图片</td>
                <td>评分</td>
                <td>所属分类ID</td>
                <td>价格</td>
                <td>月销量</td>
                <td>评分数量</td>
                <td>满意度数量</td>
                <td>满意度评分</td>
                <td>操作</td>
                <td>操作</td>
            </tr>

            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->goods_name }}</td>
                    <td><img src="{{ \Illuminate\Support\Facades\Storage::url($menu->goods_img) }}" alt="" style="width:200px"></td>
                    <td>{{ $menu->rating }}</td>
                    <td>{{ $menu->menu_category->name }}</td>
                    <td>{{ $menu->goods_price }}</td>
                    <td>{{ $menu->month_sales }}</td>
                    <td>{{ $menu->rating_count }}</td>
                    <td>{{ $menu->satisfy_count }}</td>
                    <td>{{ $menu->satisfy_rate }}</td>
                    <td>
                        <a href="{{ route('menus.create') }}" class="glyphicon glyphicon-plus"></a>&emsp;
                        <a href="{{ route('menus.edit',[$menu]) }}" class="glyphicon glyphicon-list-alt"></a>
                    </td>
                    <td>
                        <form action="{{ route('menus.destroy',[$menu]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger">删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $menus->links() }}
    </div>

@stop