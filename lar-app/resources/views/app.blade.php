<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel App</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link href="//cdn.bootcss.com/jquery-jcrop/2.0.4/css/Jcrop.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcss.com/jquery.form/3.51/jquery.form.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-jcrop/2.0.4/js/Jcrop.min.js"></script>
    <script src="//cdn.bootcss.com/vue/2.1.10/vue.min.js"></script>
    <script src="//cdn.bootcss.com/vue-resource/1.1.0/vue-resource.min.js"></script>
    <meta id="token" name="token" value="{{ csrf_token() }}">
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Laravel App</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">首页</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>
                        <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="/user/avatar"> <i class="fa fa-user"></i> 更换头像</a></li>
                            <li><a href="#"> <i class="fa fa-cog"></i> 更换密码</a></li>
                            <li><a href="#"> <i class="fa fa-heart"></i> 特别感谢</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
                        </ul>
                    </li>
                    <li>
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" width="50px;" class="img-circle">
                    </li>
                @else
                    <li><a href="/user/login">登录</a></li>
                    <li><a href="/user/register">注册</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
@yield('content')
</body>
</html>