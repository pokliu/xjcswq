@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <tr>
                <td>姓名</td>
                <td>{{ $claim->name }}</td>
            </tr>
            <tr>
                <td>申诉对象</td>
                <td>{{ $claim->post->title }}</td>
            </tr>
            <tr>
                <td>电话</td>
                <td>{{ $claim->phone }}</td>
            </tr>
            <tr>
                <td>E-mail地址</td>
                <td>{{ $claim->email }}</td>
            </tr>
            <tr>
                <td>省份与地区</td>
                <td>{{ $claim->location }}</td>
            </tr>
            <tr>
                <td>购买时间</td>
                <td>{{ $claim->bought_time }}</td>
            </tr>
            <tr>
                <td>卖出时间</td>
                <td>{{ $claim->sold_time }}</td>
            </tr>
            <tr>
                <td>描述</td>
                <td>{{ $claim->description }}</td>
            </tr>
            <tr>
                <td>操作</td>
                <td>
                    <form action="/claim/{{ $claim->id }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" type="submit">删除</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
@endsection