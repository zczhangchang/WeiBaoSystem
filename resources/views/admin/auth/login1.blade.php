<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="admin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="admin/lib/respond.min.js"></script>
    <![endif]-->
    <link href="/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>维保派单系统后台登录 </title>
    <meta name="keywords" content="H-ui.admin v3.1,H-ui">
    <meta name="description" content="H-ui.admin v3.1">
</head>
<body>
<input type="hidden" id="TenantId" name="TenantId" value="" />

<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <div style="margin-top: -30px">
            <h3 style="text-align: center"><b>维护派单系统</b></h3>
        </div>
        <form class="form form-horizontal" action="{{route('admin.auth.login1')}}" method="post">
            {{csrf_field()}}
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60d;</i></label>
                <div class="formControls col-xs-8">
                    <input id="" name="name" type="text" placeholder="用户名" class="input-text size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe60e;</i></label>
                <div class="formControls col-xs-8">
                    <input type="password" id="" name="password" type="password" placeholder="登录密码" class="input-text size-L">
                </div>
            </div>
            <div class="row c1">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <div class="checkbox" >
                        <label>
                        <input type="radio" name="role" value="普通用户" required>普通用户&nbsp;&nbsp;
                        <input type="radio"name="role" value="超级管理员" required>超级管理员&nbsp;&nbsp;
                        <input type="radio" name="role" value="维修人员" required>维修人员
                        </label>
                    </div>
                </div>
            </div>


            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online">
                        <input type="checkbox" name="online" id="online" value="">
                        使我保持登录状态</label>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.min.js"></script>
<!--此乃百度统计代码，请自行删除-->
</body>
</html>
