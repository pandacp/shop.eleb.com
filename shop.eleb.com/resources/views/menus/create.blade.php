@extends('default')

@section('contents')
    @include('_error')
    <div class="container" style="width:700px">
        <form action="{{ route('menus.store') }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">菜品名称</label>
                <input type="text" name="goods_name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('goods_name') }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">菜品图片</label>
                <input type="file" name="goods_img" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">菜品价格</label>
                <input type="text" name="goods_price" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('goods_price') }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">描述</label>
                <textarea name="description" id="" cols="30" rows="3"  class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">提示信息</label>
                <textarea name="tips" id="" cols="30" rows="2"  class="form-control">{{ old('tips') }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">所属分类ID</label>
                <select name="category_id" id="">
                    @foreach($menu_categories as $menu_category)
                        <option value="{{ $menu_category->id }}">{{ $menu_category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">添加</button>
        </form>
    </div>

@stop