@extends('default')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop

@section('js_files')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop

@section('contents')
    @include('_error')
    <div class="container" style="width:700px">
        <form action="{{ route('menus.store') }}" method="post" >
            <div class="form-group">
                <label for="exampleInputEmail1">菜品名称</label>
                <input type="text" name="goods_name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{ old('goods_name') }}" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">菜品图片</label>
                <input type="hidden" name="goods_img" id="img_url" style="width:500px">
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img id="img" style="width:200px">
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