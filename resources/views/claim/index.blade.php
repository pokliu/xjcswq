@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>姓名</th>
                <th>电话</th>
                <th>地址</th>
                <th>申报对象</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($claims as $claim)
                <tr>
                    <td>{{ $claim->name }}</td>
                    <td>{{ $claim->phone }}</td>
                    <td>{{ $claim->location }}</td>
                    <td>{{ $claim->post->title }}</td>
                    <td>{{ $claim->updated_at }}</td>
                    <td><a href="/claim/{{ $claim->id }}">查看</a></td>
                </tr>                
            @endforeach
        </tbody>
    </table>
</div>
@endsection