@extends('layouts.dist')

@section('content')
    <div class="post">
        <div class="title">
            <h3 style="text-align:center;">{{ $post->title }}</h3>
            <h4>
                来源：<span>{{ $post->admin->name }}</span>    日期：<span>{{ $post->updated_at }}</span>
            </h4>
        </div>
        <div class="content">
            @if(!is_null($post->images) && gettype($post->images) === 'array' && count($post->images) > 0)
                @foreach($post->images as $item)
                    <p class="img"><img src="/{{ $item['path'] }}" alt="{{ $item['name'] }}"></p>
                @endforeach
            @endif

            <pre>{{ $post->content }}</pre>
        </div>
        @if($post->type === 'claim')
            <div class="claim">
                <a href="/claim/create?id={{ $post->id }}">我要申报</a>
            </div>
        @endif
    </div>
@endsection