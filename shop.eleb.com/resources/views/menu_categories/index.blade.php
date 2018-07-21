@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <table class="table table-condensed">
            <tr style="background: #9dcbff">
                <td>分类名称</td>
                <td>描述</td>
                <td>所属商家ID</td>
                <td>是否默认</td>
                <td>操作</td>
                <td>操作</td>
            </tr>
            @foreach($menu_categories as $menu_category)
                <tr>
                    <td>{{ $menu_category->name }}</td>
                    <td>{{ $menu_category->description }}</td>
                    <td>{{ $menu_category->shop->shop_name }}</td>
                    <td>{{ $menu_category->is_selected }}</td>
                    <td>
                        <a href="{{ route('menu_categories.create') }}" class="glyphicon glyphicon-plus"></a>&emsp;
                        <a href="{{ route('menu_categories.edit',[$menu_category]) }}" class="glyphicon glyphicon-list-alt"></a>
                    </td>
                    <td>
                        <form action="{{ route('menu_categories.destroy',[$menu_category]) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger">删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $menu_categories->links() }}
    </div>

@stop