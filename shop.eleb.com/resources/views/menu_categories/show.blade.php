@extends('default')

@section('contents')

    <div class="container">


        <div class="col-lg-2" style="">
            <ul>
                @foreach($menu_categories as $menu_category)
                    <li style="list-style: none">
                        <form action="{{ route('menu_categories.show',[$menu_category]) }}" method="get">
                            <input type="text" name="keyword" value="{{ $menu_category->id }}" class="hidden">
                            {{ csrf_field() }}
                            <button class="btn btn-primary">{{ $menu_category->name }}</button>
                        </form>
                    </li>
                    <hr>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-10">
            <form action="{{ route('menu_categories.show',[1]) }}" method="post" class="form-inline" >
                <div class="form-group">
                    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
                    <div class="input-group">
                        <div class="input-group-addon"></div>
                        <input type="text" name="goods_name" class="form-control" id="exampleInputAmount" placeholder="菜品名称">
                        {{--<div class="input-group-addon">.00</div>--}}
                    </div>
                    <div class="input-group">
                        <input type="text" name="goods_price" class="form-control" style="width:100px;" placeholder="价格区间">
                    </div>
                    <div class="input-group">
                        --
                    </div>
                    <div class="input-group">
                        <input type="text" name="goods_price2" class="form-control" style="width:100px;" placeholder="价格区间">
                    </div>
                </div>
                {{ csrf_field() }}
                {{ method_field('GET') }}
                <button type="submit" class="btn btn-primary">搜索</button>
            </form>

            <table class="table table-bordered">
                <tr>
                    <td>菜品名称</td>
                    <td>图片</td>
                    <td>价格</td>
                </tr>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{ $menu->goods_name }}</td>
                        <td><img src="{{ $menu->goods_img }}" alt="" style="width:200px"></td>
                        <td>{{ $menu->goods_price }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $menus->appends(['keyword'=>$keyword,'goods_name'=>$goods_name,'goods_price'=>$goods_price,'goods_price2'=>$goods_price2])->links() }}
    </div>

@stop