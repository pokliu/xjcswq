<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="虚假陈述,披露,赔偿,上市公司,信息披露违法,索赔,诉讼,维权,起诉,股东,股民,虚假记载,重大遗漏,不当披露,误导性陈述,证监会,处罚,投资差额损失,代理,律师,法院" >
        <meta name="description" content="虚假陈述维权网是国内首家第三方为股民投资者提供维权索赔费用支持的法律网站，实现广大股民前期超低成本乃至无成本维权索赔。" >

        <title>虚假陈述维权网</title>

        <!-- Styles -->
        @yield('links')
        <link rel="stylesheet" href="{{ asset('css/dist.css') }}">
    </head>
    <body>
        <div class="header">
            <div class="title">
                <div class="box">
                    <div class="name">虚假陈述维权网</div>
                    <span class="sub">Misrepresentation Litigation</span>
                </div>
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
