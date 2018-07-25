@extends('default')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop

@section('js_files')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop

@section('contents')
    @include('_error')
    <div class="container">
        <form action="{{ route('shops.store') }}" method="post" enctype="multipart/form-data">
            <div>
                <h2>---商户信息---</h2>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺名称</label>
                <input type="text" name="shop_name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('name') }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店铺图片</label>
            <input type="hidden" name="shop_img" id="img_url" style="width:500px">
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
             </div>
            <img id="img" style="width:200px">
            <div class="form-group">
                <label for="exampleInputEmail1">店铺评分</label>
                <input type="text" name="shop_rating" class="form-control" id="exampleInputEmail1" placeholder="" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否品牌</label>
                是:<input type="radio" name="brand" value="1" id="exampleInputEmail1" checked>
                否:<input type="radio" name="brand" value="0" id="exampleInputEmail2" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否准时送达</label>
                是:<input type="radio" name="on_time" value="1" id="exampleInputEmail1" checked>
                否:<input type="radio" name="on_time" value="0" id="exampleInputEmail2" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否蜂鸟</label>
                是:<input type="radio" name="fengniao" value="1" id="exampleInputEmail1" checked>
                否:<input type="radio" name="fengniao" value="0" id="exampleInputEmail2" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否保标记</label>
                是:<input type="radio" name="bao" value="1" id="exampleInputEmail1" checked>
                否:<input type="radio" name="bao" value="0" id="exampleInputEmail2" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否票标记</label>
                是:<input type="radio" name="piao" value="1" id="exampleInputEmail1" checked>
                否:<input type="radio" name="piao" value="0" id="exampleInputEmail2" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">是否准标记</label>
                是:<input type="radio" name="zhun" value="1" id="exampleInputEmail1" checked>
                否:<input type="radio" name="zhun" value="0" id="exampleInputEmail2" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">起送金额</label>
                <input type="text" name="start_send" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('start_send') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">配送费</label>
                <input type="text" name="send_cost" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('send_cost') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">店公告</label>
                <textarea name="notice" id="" cols="30" rows="3"  class="form-control">{{ old('notice') }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">优惠信息</label>
                <textarea name="discount" id="" cols="30" rows="3"  class="form-control">{{ old('notice') }}</textarea>
            </div>
{{--添加商家信息--}}
{{--添加用户--}}
            <div class="form-group">
                <label for="exampleInputEmail1">店铺分类</label>
                <select name="shop_category_id" id="">
                    @foreach($shop_categories as $shop_category)
                        <option value="{{ $shop_category->id }}">{{ $shop_category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group hidden" >
                <label for="exampleInputEmail1">审核状态</label>
                <select name="status" id="" >
                    <option value="1" >正常</option>
                    <option value="0" selected>待审核</option>
                    <option value="-1">禁用</option>
                </select>
            </div>
            <div>
                <h2>---注册用户---</h2>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">用户名</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="用户名" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">邮箱</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="邮箱" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">所属商家</label>
                <select name="shop_id" id="">
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">状态</label>
                启用:<input type="radio" name="status" value="1" id="exampleInputEmail1" placeholder="">
                禁用:<input type="radio" name="status" value="0" checked="checked" id="exampleInputEmail2" placeholder="">
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">添加商户信息及商家账户</button>
        </form>

{{--添加用户表单--}}

{{--添加用户表单--}}
    </div>

    {{--<div class="form-group">--}}
        {{--<label for="exampleInputFile">File input</label>--}}
        {{--<input type="file" id="exampleInputFile">--}}
        {{--<p class="help-block">Example block-level help text here.</p>--}}
    {{--</div>--}}
@stop
@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
//        swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: "{{ route('upload') }}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/gif,image/jpg,image/jpeg,image/bmp,image/png,'
            },
            formData:{
                _token:'{{ csrf_token() }}'
            }
        });
        uploader.on('uploadSuccess',function(file,response){

            $('#img').attr('src',response.filename);
            $('#img_url').val(response.filename)
        })
    </script>
@stop