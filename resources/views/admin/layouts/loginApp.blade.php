<!DOCTYPE html>

<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
    <style>
        #image{
            background-image: url("../../../../public/layadmin/modul/login/bg.jpg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            z-index: -1;
        }
    </style>
@yield('pageStyle')
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini"style="background-color: #d6eeff" id="image">

@yield('pageContent')
<!-- jQuery 3 -->
<script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/js/adminlte.min.js"></script>
<script src="/admin/plugins/bootstrap-notify/bootstrap-notify.js"></script>
<script src="https://browser.sentry-cdn.com/5.0.7/bundle.min.js" crossorigin="anonymous"></script>
<script src="/admin/plugins/iCheck/icheck.min.js"></script>
<script>
    @if(session()->has('message.level'))
    $('.top-right').notify({
        message: {text: '{!! session('message.content') !!}'},
        type: '{!! session('message.level') !!}',
        fadeOut: {enabled: true, delay: 3000}
    }).show();
    @endif
</script>
@yield('pageScript')
</body>
</html>
