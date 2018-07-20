@extends('default')

@section('contents')
    @include('_error')
    <div class="container" style="">
        <form action="{{ route('users.reset',[$user]) }}" method="post" class="form-group">
            <div style="width:500px">
                <div class="form-group">
                <label for="exampleInputPassword1">旧密码</label>
                <input type="password" name="old_password" class="form-control" id="exampleInputPassword1" placeholder="旧密码">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">密码</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="新密码">
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">确认密码</label>
                <input type="password" name="repassword" class="form-control" id="exampleInputPassword1" placeholder="确认密码">
                </div>
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                {{ csrf_field() }}
                {{ method_field("PATCH") }}
                输入验证码:<input id="captcha" class="form-control" name="captcha" >
                {{ csrf_field() }}
                {{ method_field("PATCH") }}
                <button class="btn btn-block btn-primary">提交</button>
            </div>
        </form>
    </div>
@stop