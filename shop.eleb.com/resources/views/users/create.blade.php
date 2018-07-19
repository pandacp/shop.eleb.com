@extends('default')

@section('contents')
    @include('_error')
    <div class="container">
        <form action="{{ route('users.store') }}" method="post">
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
            {{--<div class="checkbox">--}}
                {{--<label>--}}
                    {{--<input type="checkbox" name="rememberToken"> 记住我--}}
                {{--</label>--}}
            {{--</div>--}}
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    {{--<div class="form-group">--}}
        {{--<label for="exampleInputFile">File input</label>--}}
        {{--<input type="file" id="exampleInputFile">--}}
        {{--<p class="help-block">Example block-level help text here.</p>--}}
    {{--</div>--}}
@stop