@extends('layouts.dist')

@section('content')
    <div class="list">
        <div class="title"><h4>{{ $type_name }}</h4></div>
        <div class="main">
            <ul>
                @if(count($data) === 0)
                    <li>暂无{{ $type_name }}的数据记录</li>
                @else
                    @foreach($data as $item)
                        <li>
                            <a href="/post/{{ $item->id }}?type={{ $item->type }}">
                                <span class="name">{{ $item->title }}</span>
                                <span class="time">{{  $item->updated_at }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection