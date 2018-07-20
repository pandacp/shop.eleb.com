@extends('default')

@section('contents')
    @include('_error')

    <div style="width:300px" class="container">
        <form action="{{ route('login') }}" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">用户名</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="用户名" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">请输入验证码</label>
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                {{ csrf_field() }}
                <input id="captcha" class="form-control" name="captcha" >
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="rememberToken" value="1"> 记住我
                </label>
            </div>
            {{ csrf_field() }}
            <button type="submit" class="btn btn-primary">登录</button>
        </form>
    </div>

@stop