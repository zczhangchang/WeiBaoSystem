<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('pageTitle')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="renderer" content="webkit">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/admin/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/css/AdminLTE.min.css">
    <!-- AdminLTE Skins -->
    <link rel="stylesheet" href="/admin/css/skins/_all-skins.min.css">
    <!-- notify -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-notify/bootstrap-notify.css">
    <link rel="stylesheet" href="/admin/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="/admin/layui-v2.5.4/layui/css/layui.css"  media="all">
@yield('pageStyle')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>派单</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>维护派单系统</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/admin/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs">管理员</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ route('admin.auth.logout') }}" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    @inject('menus','App\Services\SidebarService')

    <aside class="main-sidebar">
        <section class="sidebar">
            <form class="" method="" action="">


            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="{{'/myOrder/list'}}">
                        <i class="fa fa-circle-o"></i>

                        <span>我的工单</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>
                        <span>工单管理</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: none;">
                        <li class="active"><a href="{{'/order/list'}}"><i class="fa fa-circle-o"></i> 工单列表</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-circle-o"></i>
                        <span>派单管理</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu" style="display: none">
                        <li class="active"><a href="{{'/dispach/list'}}"><i class="fa fa-circle-o"></i>特派工单</a></li>
                    </ul>
                </li>
                <li>


                    <a href="{{'/address/list'}}">
                        <i class="fa fa-circle-o"></i>
                        <span>报修地点设置</span>
                    </a>
                </li>
                <li>
                    <a href="{{'/backOrder/list'}}">
                        <i class="fa fa-circle-o"></i>
                        <span>退回工单</span>
                    </a>
                </li>
                <li>
                    <a href="{{'/maintenance/list'}}">
                        <i class="fa fa-circle-o"></i>
                        <span>维修人员</span>
                    </a>
                </li>
                <li>
                    <a href="{{'/user/list'}}">
                        <i class="fa fa-circle-o"></i>
                        <span>用户管理</span>
                    </a>
                </li>
                <li>
                    <a href="{{'/orderStatistics/list'}}">
                        <i class="fa fa-circle-o"></i>
                        <span>任务统计</span>
                    </a>
                </li>
            </ul>
            </form>
        </section>
        {{--        <div class=""></div>--}}
    </aside>
    <!-- Content Wrapper. Contains page content -->

@yield('pageContent')
<!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> {{ env('VERSION') }}
        </div>
        <strong></strong> All rights reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div class='notifications top-right' style="width:320px;"></div>
<!-- jQuery 3 -->
<script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/js/adminlte.min.js"></script>
<script src="/admin/js/echarts.js"></script>
<script src="/admin/plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="https://browser.sentry-cdn.com/5.0.7/bundle.min.js" crossorigin="anonymous"></script>
<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script src="/admin/layui-v2.5.4/layui/layui.js" charset="utf-8"></script>



<script>
    Sentry.init({dsn: 'https://a3628b94f24b43df8f27391fe9172c2e@sentry.io/1438842'});
</script>
<script>
    @if(session()->has('message.level'))
    $('.top-right').notify({
        message: {text: '{!! session('message.content') !!}'},
        type: '{!! session('message.level') !!}',
        fadeOut: {enabled: true, delay: 3000}
    }).show();
    @endif
</script>
<script>
    $(function () {
        $('.sidebar-menu li:not(.treeview) > a').on('click', function () {
            var $parent = $(this).parent().addClass('active');
            $parent.siblings('.treeview.active').find('> a').trigger('click');
            $parent.siblings().removeClass('active').find('li').removeClass('active');
        });

        $(window).on('load', function () {
            $('.sidebar-menu a').each(function () {
                var urlObj = $('.sidebar-menu a[href="' + window.location.origin + window.location.pathname + '"]:first');
                if (urlObj.length === 0) {
                    return;
                }
                var url = urlObj[0].href;
                if (this.href === url) {
                    $(this).parent().addClass('active')
                        .closest('.treeview-menu').addClass('.menu-open')
                        .closest('.treeview').addClass('active');
                }
            });
        });
    });
</script>
@yield('pageScript')
</body>
</html>
