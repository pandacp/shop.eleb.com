@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <form action="{{ route('menu_categories.store',[$menu_category]) }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">分类名称</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('name') }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">描述</label>
                <textarea name="description" id="" cols="30" rows="3"  class="form-control">{{ old('description') }}</textarea>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="exampleInputEmail1">所属商家ID</label>--}}
                {{--<select name="shop_id" id="">--}}
                    {{--@foreach($shops as $shop)--}}
                        {{--<option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="exampleInputEmail1">是否默认分类</label>
                是:<input type="radio" name="is_selected" value="1" id="exampleInputEmail1" >
                否:<input type="radio" name="is_selected" value="0" id="exampleInputEmail2" checked>
            </div>

            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">提交</button>
        </form>
    </div>

    {{--<div class="form-group">--}}
        {{--<label for="exampleInputFile">File input</label>--}}
        {{--<input type="file" id="exampleInputFile">--}}
        {{--<p class="help-block">Example block-level help text here.</p>--}}
    {{--</div>--}}
@stop