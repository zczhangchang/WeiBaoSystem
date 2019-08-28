@extends('admin.layouts.loginApp')

@section('pageTitle','登录')

@section('pageStyle')
    <style>
        #image{
            background-image: url("../../../../public/layadmin/modul/login/bg.jpg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            z-index: -1;
        }
        .bgpic{
            position:absolute;
            z-index: -1;
            width: 100%;
            height: 200%;
        }
    </style>
@stop

@section('pageScript')
    <script src="//cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    <script>



    </script>
@stop
@section('pageContent')
    <img class="bgpic" src="/layadmin/modul/login/bg.jpg">
    <body class="hold-transition login-page" id="image">

    <div class="login-box">
        <div class="login-logo">
            <h2><b>维护派单系统</b></h2>
        </div>
        <div class="login-box-body">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul style="color:red;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <p class="login-box-msg">请输入登录信息</p>
            <form action="{{ route('admin.auth.login') }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group{{$errors->has('name') ? 'has-error' : ''}} has-feedback">
                    <input type="text" class="form-control" placeholder="用户名" name="name" style="width: 320px">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="登录密码" name="password" style="width: 320px">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-12" >
                        <button type="submit" class="btn btn-primary btn-block btn-flat" >登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>

@stop

