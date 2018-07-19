@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <form action="{{ route('shops.update',[$shop]) }}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">店铺名称</label>
                <input type="text" name="shop_name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $shop->shop_name }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺图片</label>
                <input type="file" name="shop_img"  id="exampleInputEmail1" placeholder="" >
                <img src="{{ \Illuminate\Support\Facades\Storage::url($shop->shop_img) }}" alt="" style="width:200px">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺评分</label>
                <input type="text" name="shop_rating" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $shop->shop_rating }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否品牌</label>
                是:<input type="radio" name="brand" value="1" @if($shop->brand==1)checked @endif  id="exampleInputEmail1" >
                否:<input type="radio" name="brand" value="0" @if($shop->brand!=1)checked @endif id="exampleInputEmail2" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否准时送达</label>
                是:<input type="radio" name="on_time" value="1" id="exampleInputEmail1" @if($shop->on_time==1)checked @endif>
                否:<input type="radio" name="on_time" value="0" id="exampleInputEmail2" placeholder="" @if($shop->on_time!=1)checked @endif>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否蜂鸟</label>
                是:<input type="radio" name="fengniao" value="1" id="exampleInputEmail1" @if($shop->fengniao==1)checked @endif>
                否:<input type="radio" name="fengniao" value="0" id="exampleInputEmail2" placeholder="" @if($shop->fengniao!=1)checked @endif>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否保标记</label>
                是:<input type="radio" name="bao" value="1" id="exampleInputEmail1" @if($shop->bao==1)checked @endif>
                否:<input type="radio" name="bao" value="0" id="exampleInputEmail2" placeholder="" @if($shop->bao!=1)checked @endif>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否票标记</label>
                是:<input type="radio" name="piao" value="1" id="exampleInputEmail1" @if($shop->piao==1)checked @endif>
                否:<input type="radio" name="piao" value="0" id="exampleInputEmail2" placeholder="" @if($shop->piao!=1)checked @endif>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否准标记</label>
                是:<input type="radio" name="zhun" value="1" id="exampleInputEmail1" @if($shop->zhun==1)checked @endif>
                否:<input type="radio" name="zhun" value="0" id="exampleInputEmail2" placeholder="" @if($shop->zhun!=1)checked @endif>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">起送金额</label>
                <input type="text" name="start_send" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $shop->start_send }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">配送费</label>
                <input type="text" name="send_cost" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ $shop->send_cost }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店公告</label>
                <textarea name="notice" id="" cols="30" rows="3"  class="form-control">{{ $shop->notice }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">优惠信息</label>
                <textarea name="discount" id="" cols="30" rows="3"  class="form-control">{{ $shop->discount }}</textarea>
            </div>


            <div class="form-group">
                <label for="exampleInputEmail1">店铺分类</label>
                <select name="shop_category_id" id="">
                    @foreach($shop_categories as $shop_category)
                        <option value="{{ $shop_category->id }}">{{ $shop_category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">审核状态</label>
                <select name="status" id="">
                    <option value="1" selected>正常</option>
                    <option value="0" >待审核</option>
                    <option value="-1">禁用</option>
                </select>
            </div>
            {{--<div class="checkbox">--}}
                {{--<label>--}}
                    {{--<input type="checkbox" name="rememberToken"> 记住我--}}
                {{--</label>--}}
            {{--</div>--}}
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