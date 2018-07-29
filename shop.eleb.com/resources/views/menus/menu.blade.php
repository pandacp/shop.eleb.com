@extends('default')

@section('contents')
    <div class="container" style="text-align: center">
        <table class="table table-bordered">
            <tr>
                <td>菜名</td>
                <td>{{ $sell }}</td>
            </tr>
            <tr>
                <td>{{ $name }}</td>
                <td>{{ $amount }}</td>
            </tr>
        </table>
        <a href="{{ route('menus.index') }}"><span style="font-size: 30px">返回</span></a>
    </div>
@stop