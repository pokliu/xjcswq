@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-bottom: 8px">
        <a role="button" class="btn btn-primary" href="/post/create?type={{ $data->type }}">创建新{{ $data->type_name }}</a>
    </div>

    <div class="row">
        <table class="table">
            <thead>
                <th>{{ $data->type_name }}</th>
                <th>编辑人</th>
                <th>编辑时间</th>
                <th>操作</th>
            </thead>
            <tbody> 
                @foreach($data->list as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->admin->name }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a href="/post/{{ $item->id }}/edit">编辑</a>
                            <a href="#" onclick="event.preventDefault();
                                if(confirm('确定要删除吗？')){
                                    document.getElementById('delete-form').setAttribute('action', '/post/{{ $item->id }}');
                                    document.getElementById('delete-form').submit();
                                }                                
                            ">删除</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form id="delete-form" action="/post/" method="POST" style="display: none;">
            @csrf
            {{ method_field('DELETE') }}
        </form>
    </div>
</div>
@endsection