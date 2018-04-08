<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>虚假陈述维权网</title>

        <!-- Styles -->
        @yield('links')
        <link rel="stylesheet" href="{{ asset('css/dist.css') }}">
    </head>
    <body>
        <div class="header">
            <div class="title">
                <div class="name">虚假陈述维权网</div>
                <span class="sub">Misrepresentation Litigation</span>
            </div>
            <div class="nav">
                <ul>
                    <li><a class="name" href="/">首页</a></li>
                    <li><a class="name" href="/list?type=information">动态</a></li>
                    <li><a class="name" href="/list?type=case">案例分析</a></li>
                    <li><a class="name" href="/list?type=claim">索赔名单</a></li>
                    <li><a class="name" href="/static/contact">联系我们</a></li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="container">
                @yield('content')
            </div>
        </div>
        <div class="footer">
            <span>粤ICP备18031461号-1</span>
            <span>©2018 虚假陈述集结号</span>
        </div>
        <div class="bg"></div>
    </body>
    <script src="/js/jquery.min.js"></script>
    <script src="{{ asset('/js/dist.js') }}"></script>
    @yield('scripts')
</html>
