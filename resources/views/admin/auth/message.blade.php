@extends('admin.layouts.loginApp')


@section('pageTitle','登录判断')

@section('pageStyle')
    <style>
        .daohangl{
            float: left;
            padding: 15px 15px 10px;
        }
    </style>
        @stop

        @section('pageScript')
            <script src="//cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
            <script>


                </script>

            <!-- 失败提示框 -->

                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>用户名或密码错误，登录失败!</strong> {{Session::get('error')}}
                </div>

    @stop
