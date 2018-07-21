@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <form action="{{ route('menu_categories.update',[$menu_category]) }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $menu_category->name }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">描述</label>
                <textarea name="description" id="" cols="30" rows="3"  class="form-control">{{ $menu_category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否默认分类</label>
                是:<input type="radio" name="is_selected" value="1" id="exampleInputEmail1" >
                否:<input type="radio" name="is_selected" value="0" id="exampleInputEmail2" checked>
            </div>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>

    {{--<div class="form-group">--}}
        {{--<label for="exampleInputFile">File input</label>--}}
        {{--<input type="file" id="exampleInputFile">--}}
        {{--<p class="help-block">Example block-level help text here.</p>--}}
    {{--</div>--}}
@stop