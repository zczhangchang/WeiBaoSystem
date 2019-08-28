@extends('admin.layouts.app')


@section('pageTitle','任务统计')

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




@stop

@section('pageContent')
    <body class="skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- 用户列表 -->
        <div id="list" class="content-wrapper" style="min-height: 976px;background-color: #ecf0f5;display: block">
            <!-- 页面标题 -->
            <section class="content-header" style="height: 50px">
                <h1 style="float: left;padding-top: 8px"><b>
                        任务统计
                    </b></h1>
            </section>


            <section class="content" >
                <div class="row">
                    <div class="col-xs-10">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>任务统计</b></h3>
                            </div>
                            <div class="box-body no-padding">

                                <div class="box-body">
                                    <div class="row">
                                        <form class="" action="{{url('/orderStatistics/list')}}" method="post">

                                            {{ csrf_field()}}


                                        </form>
                                    </div>
                                </div>

                                <form class="" method="post" action="{{url('/orderStatistics/list')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">
                                    <table class="table table-striped" style="font-size: 18px">
                                        <tbody><tr>
                                            <th style="text-align: center">序号</th>
                                            <th style="text-align: center">维修人</th>
                                            <th style="text-align: center">待维修（单位：件）</th>
                                            <th style="text-align: center">完成合计（单位：件）</th>
                                        </tr>

                                        @foreach($orders as $indexKey => $order)

                                        <tr style="text-align: center">
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->maintenance_personnel}}</td>
                                            <td>2</td>
                                            <td>4</td>
                                        </tr>
                                            @endforeach

                                        </tbody></table>
                                </form>
                            </div>
                            <!-- /.box-body -->

                            <div class="container" style="padding-right: 400px">
                                <ul class="pager">
                                    <li><a href="#">上一页</a></li>
                                    <li><a href="#">下一页</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
    </body>




@stop

