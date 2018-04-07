@extends('layouts.dist')

@section('content')
    <div class="post">
        <div class="title">
            <h3 style="text-align:center;">@yield('title')</h3>
        </div>
        <div class="content">
            <p>
                @yield('main')
            </p>
        </div>
    </div>
@endsection