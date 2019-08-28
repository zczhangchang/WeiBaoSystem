@extends('admin.layouts.app')

@section('pageTitle','工单管理')

@section('pageStyle')
    <style>

    </style>
@stop

@section('pageScript')
    <script src="//cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>

    <script>
        layui.use('laydate', function() {
            var laydate = layui.laydate;
            //日期范围
            laydate.render({
                elem: '#range'
                , range: true
            });
        });
    </script>
    <script>
        $('.back').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('backOrder') }}', {
                id: id,
            })
                .then(function (response) {
                    console.log(response);
                    var data = response.data;
                    if (data.code === 1) {
                        $('.top-right').notify({
                            message: {text: data.msg},
                            type: 'success',
                            fadeOut: {enabled: true, delay: 500},
                            onClose: function () {
                                window.location.reload();
                            }
                        }).show();
                        window.location.reload();
                    } else {
                        $('.top-right').notify({
                            message: {text: data.msg},
                            type: 'danger',
                            fadeOut: {enabled: true, delay: 500},
                            onClose: function () {
                                window.location.reload();
                            }
                        }).show();
                    }

                })
                .catch(function (error) {
                    console.log(error);
                    $('.top-right').notify({
                        message: {text: '撤单成功'},
                        type: 'success',
                        fadeOut: {enabled: true, delay: 500},
                        onClose: function () {
                            window.location.reload();
                        }
                    }).show();
                });
        });
        //派单
        $('.give').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('giveOrder') }}', {
                id: id,
            })
                .then(function (response) {
                    console.log(response);
                    var data = response.data;


                })
                .catch(function (error) {
                    console.log(error);
                    $('.top-right').notify({
                        message: {text: '派单成功'},
                        type: 'success',
                        fadeOut: {enabled: true, delay: 500},
                        onClose: function () {
                            window.location.reload();
                        }
                    }).show();
                });
        });
    </script>

    <script>
        $('.details').on('click', function () {
            var id = $(this).data('id');
            $('.details-order-id').val(id);

            var applicant = $(this).data('applicant');
            $('.details-order-applicant').val(applicant);

            var place = $(this).data('place');
            $('.details-order-place').val(place);

            var phone = $(this).data('phone');
            $('.details-order-phone').val(phone);
        });



    </script>
    <script>


        var App = {
            init : function(){this.setInt()},
            chang : function(){
                if (App.time[1]) {
                    App.time[1]--
                }else {
                    if(App.time[0]){
                        App.time[0]--;
                        App.time[1]=60;
                    }else {
                        clearInterval(App.bb);
                        return document.getElementById('box').innerHTML='over';
                    }
                }

                document.getElementById('box').innerHTML=App.time.join(':')
            },
            setInt : function(){
                this.bb = setInterval('App.chang()',1000)
            },
            bb :'',
            time : [60]
        }
        App.init()
    </script>

@stop

@section('pageContent')
    <body class="skin-blue sidebar-mini" onload = "countTime()">
    <div class="wrapper">
        <!-- 所有工单列表展示 -->
        <div id="list" class="content-wrapper" style="min-height: 976px;background-color: #ecf0f5;display: block">
            <!-- 页面标题 -->
            <section class="content-header" style="height: 50px">
                <h1 style="float: left;padding-top: 8px"><b>
                        所有工单列表
                    </b></h1>
            </section>
            <!-- 查询表单 -->
            <section style="margin-top: 30px">
                <form class="" method="post" action="{{'/order/select'}}">
                    {!! csrf_field() !!}



                    <div class="col-xs-12"><label class="col-xs-2" for="applicant" style="text-align: right">申请人:</label>
                        <input name="Order[applicant]" type="text" id="applicant" placeholder="" class="col-xs-2" value="{{ Request('Order')['applicant'] }}">
                        <label for="maintenance_personnel" class="col-xs-2" style="text-align: right">维修人:</label>
                        <input name="Order[maintenance_personnel]" type="text" id="maintenance_personnel" placeholder="" class="col-xs-2" value="{{Request('Order')['maintenance_personnel']}}" >&nbsp;&nbsp;
                        <button type="select" class="btn btn-primary" style="margin-left: 20px;height: 30px;text-align: center" onclick="select()">查询</button></div>
                    <br>
                    <div class="col-xs-12" style="margin-top: 10px"><label for="status" class="col-xs-2" style="text-align: right">状态:</label>


                        <select name="status" class="col-xs-2" id="status">
                            <option value="{{'status'}}">全部</option>
                            <option value="{{'status'}}">无状态</option>
                            <option value="{{'status'}}">已派单</option>

                        </select>




                        <label for="departments_applicants" class="col-xs-2" style="text-align: right">报修人所属部门:</label>
                        <input  name="Order[departments_applicants]" type="text" id="departments_applicants" placeholder="" class="col-xs-2" value="{{Request('Order')['departments_applicants']}}" >&nbsp;&nbsp;
                    </div><br>
                    <div class="col-xs-12" style="margin-top: 10px"><label class="col-md-2" for="start" style="text-align: right">起始时间:</label>
                        <input type="date" id="start" placeholder="" class="col-xs-2">&nbsp;&nbsp;
                        <label for="end" class="col-xs-2" style="text-align: right">结束时间:</label>
                        <input type="date" id="end" placeholder="" class="col-xs-2">&nbsp;&nbsp;</div><br>
                    <div class="col-xs-12" style="margin-top: 10px">
                        <label class="col-md-2" for="range" style="text-align: right">按时间查询:</label>
                        <input type="text" class="col-xs-6" id="range" placeholder=" - " style="height: 30px">
                    </div>

                </form>
            </section>
            <!-- 页面内容 -->
            <section class="content" style="margin-top: 30px">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>工单列表</b></h3>
                            </div>

                            {{--                            <div style="background-color: white">--}}
                            {{--                                <div id="result">--}}

                            {{--                                </div>--}}
                            {{--                                <button onclick="djs()">--}}
                            {{--                                    倒计时--}}
                            {{--                                </button>--}}
                            {{--                            </div>--}}

                            <div class="box-body no-padding">
                                <form class="" action="{{'/order/list'}}" method="post">
                                    <table class="table table-striped" style="font-size: 18px">
                                        <tbody><tr>
                                            <th style="width: 10px">id</th>
                                            <!--  订单的名称 发起人 绑定的维修人员 维修内容 退单原因 创建时间 修改时间 -->
                                            <!--  状态：1.初始2.处理中3.退单4.完结5.删除 -->
                                            <th style="text-align: center">设备名称</th>
                                            <th style="text-align: center">申请人</th>
                                            <th style="text-align: center">地点</th>

                                            <th style="text-align: center">故障信息</th>
                                            <th style="text-align: center">申请日期</th>
                                            <th style="text-align: center">维修人</th>
                                            <th style="text-align: center">是否指定维修人员</th>
                                            <th style="text-align: center">报修人所属部门</th>
                                            <th style="text-align: center">规定完成时间倒计时</th>
                                            <th style="text-align: center">状态</th>
                                            <th style="text-align: center">缓急情况</th>
                                            <th style="text-align: center">操作</th>

                                        </tr>

                                        @foreach($orders as $order)
                                            <tr style="text-align: center">
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->name_order}}</td>
                                                <td>{{$order->applicant}}</td>
                                                <td>{{$order->place}}</td>
                                                <td>{{$order->fault}}</td>
                                                <td>{{$order->date_application}}</td>
                                                <td>{{$order->maintenance_personnel}}</td>
                                                <td>{{$order->designated_personel}}</td>
                                                <td>{{$order->departments_applicants}}</td>
                                                <td style="color: blue" id="result1">

                                                    <div id = 'box' style='width:50%; border:1px solid red; height:20px'>ing...</div>

                                                </td>
                                                @if($order['state'] ==2)
                                                    <td><span class="badge bg-yellow">已派单</span></td>
                                                @elseif($order['state']==0)
                                                    <td><span class="badge bg-blue">正在退回</span></td>
                                                @else
                                                    <td><span class="badge bg-green">无状态</span></td>
                                                @endif
                                                <td><span class="badge bg-red">{{$order->danger}}</span></td>
                                                <td>
                                                    @if($order['state'] ==2)
                                                        <span class="badge btn bg-light-blue details"
                                                              data-id="{{ $order['id'] }}"
                                                              data-applicant="{{ $order['applicant'] }}"
                                                              data-place="{{ $order['place'] }}"
                                                              data-phone="{{ $order['phone'] }}"
                                                              data-toggle="modal" data-target="#details-modal" >查看</span>
                                                        {{--                                                    <span class="bg-light-blue badge btn back"--}}
                                                        {{--                                                          data-id="{{$order['id']}}">撤单</span>--}}
                                                    @elseif($order['state']==0)
                                                        <span class="badge btn bg-light-blue details"
                                                              data-id="{{ $order['id'] }}"
                                                              data-applicant="{{ $order['applicant'] }}"
                                                              data-place="{{ $order['place'] }}"
                                                              data-phone="{{ $order['phone'] }}"
                                                              data-toggle="modal" data-target="#details-modal" >查看</span>
                                                    @else
                                                        <span class="badge btn bg-light-blue details"
                                                              data-id="{{ $order['id'] }}"
                                                              data-applicant="{{ $order['applicant'] }}"
                                                              data-place="{{ $order['place'] }}"
                                                              data-phone="{{ $order['phone'] }}"
                                                              data-toggle="modal" data-target="#details-modal" >查看</span>
                                                        <span class="badge btn bg-light-blue give"
                                                              data-id="{{$order['id']}}">派单</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody></table>
                                </form>
                            </div>


                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- 查看详情页面 -->
        <div class="modal fade" id="details-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">工单详情</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="get" action="{{'/order/details'}}">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control details-order-id" name="id">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>申请人:</label>
                                    <input type="text" class="form-control details-order-applicant" name="applicant"
                                           placeholder="申请人" value="{{ old('applicant') }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>地点:</label>
                                    <input type="text" class="form-control details-order-place" name="place"
                                           placeholder="地点" value="{{ old('place') }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>联系方式:</label>
                                    <input type="tel" class="form-control details-order-phone"
                                           placeholder="联系方式" name="phone" value="{{ old('phone') }}" readonly>
                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>
    </body>
@stop
