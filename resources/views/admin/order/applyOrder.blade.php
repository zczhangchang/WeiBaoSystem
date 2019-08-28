@extends('admin.layouts.app')

@section('pageTitle','我的工单')

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
        layui.use('laydate', function() {
            var laydate = layui.laydate;

            //日期时间选择器
            laydate.render({
                elem: '#deadline',
                type: 'datetime'
            });
        });
    </script>
    <script>
        function Applicant() {
            document.getElementById('list').style.display='none';
            document.getElementById('applicantHtml').style.display='block';
        }
    </script>

    <script>
        $('.submit').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('submitOrder') }}', {
                id: id,
            })
                .then(function (response) {
                    console.log(response);
                    var data = response.data;


                })
                .catch(function (error) {
                    console.log(error);
                    $('.top-right').notify({
                        message: {text: '退回成功'},
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
        window.onload = function getTime(){
            var st = showtime();
            document.getElementById("date_application").value = st;
        }
        function showtime()
        {
            today=new Date();
            var year=today.getFullYear();
            var month=today.getMonth()+1;
            var day=today.getDate();
            var hours=today.getHours();
            var minutes=today.getMinutes();
            var seconds=today.getSeconds();
            var timeValue= year;
            timeValue += ((month < 10) ? "-0" : "-") + month+"";
            timeValue += ((day < 10) ? "-0" : "-") + day+"";
            timeValue += ((hours<10) ? " 0" : " ") +hours+"";
            timeValue += ((minutes<10) ? ":0":":") +minutes+"";
            timeValue +=((seconds<10) ? ":0":":") +seconds+"";
            return timeValue;
        }
    </script>
    <script>
        function isNot() {
            document.getElementById('mainname').style.display='block';
        }
    </script>
    <script>
        function disappear() {
            document.getElementById('mainname').style.display='none';
        }

        function intend() {
            document.getElementById('reason').style.display='block';
        }
    </script>


    <script>


        //退回理由填写返回（编辑）
        // $('.back').on('click', function () {
        //     var id = $(this).data('id');
        //     $('.update-order-id').val(id);
        //
        //     var reason = $(this).data('reason');
        //     $('.update-order-reason').val(reason);
        //
        //     $('input:checkbox').each(function () {
        //         $(this).attr('checked', false);
        //     });
        // });


        $('.back').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('backOrder') }}', {
                id: id,
            })
                .then(function (response) {
                    console.log(response);
                    var data = response.data;


                })
                .catch(function (error) {
                    console.log(error);
                    $('.top-right').notify({
                        message: {text: '退单成功'},
                        type: 'success',
                        fadeOut: {enabled: true, delay: 500},
                        onClose: function () {
                            window.location.reload();
                        }
                    }).show();
                });
        });
    </script>




@stop

@section('pageContent')
    <body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <div id="list" class="content-wrapper" style="min-height: 976px;background-color: #ecf0f5;display: block">
            <!-- 页面标题 -->
            <section class="content-header" style="height: 50px">
                <h1 style="float: left;padding-top: 8px"><b>
                        个人申请工单列表
                    </b></h1>
                <div style="width: 160px;height: 30px;float: left;padding-left: 10px;">
                    <button type="button" class="btn btn-block btn-success btn-lg" style="font-size: 16px" onclick="Applicant()">申请工单</button></div>
            </section>
            <section class="content" >
                <div class="row">

                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>我的工单</b></h3>
                            </div>
                            <div class="box-body no-padding">
                                <form class="" method="post" action="{{'/myOrder/list'}}" enctype="multipart/form-data">
                                    {!! csrf_field() !!}

                                    <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">
                                    <table class="table table-striped" style="font-size: 18px">
                                        <tbody>
                                        <tr style="text-align: center">
                                            <th style="text-align: center">id</th>
                                            <th style="text-align: center">设备名称</th>
                                            <th style="text-align: center">申请人</th>
                                            <th style="text-align: center">地点</th>
                                            <th style="text-align: center">故障信息</th>
                                            <th style="text-align: center">申请日期</th>
                                            <th style="text-align: center">维修人</th>
                                            <th style="text-align: center">是否指定维修人员</th>
                                            <th style="text-align: center">报修人所属部门</th>
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
                                                @if($order['state'] ==1)
                                                    <td><span class="badge bg-green">无状态</span></td>
                                                @elseif($order['state']==2)
                                                    <td><span class="badge bg-yellow">已派单</span></td>
                                                @else
                                                    <td><span class="badge bg-blue">正在退回</span></td>
                                                @endif
                                                <td><span class="badge bg-red">{{$order->danger}}</span></td>
                                                <td>
                                                    @if($order['state']==0)
                                                        <span></span>
                                                    @else
                                                        <span class="badge btn bg-light-blue back"
                                                              data-target="#back-modal" data-toggle="modal"
                                                              data-id="{{$order['id']}}" data-reason="{{$order['reason']}}">
                                            退回</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody></table>
                                </form>
                            </div>
                            <!-- /.box-body -->

                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--申请工单页面  -->
        <div id="applicantHtml" class="content-wrapper" style="min-height: 976px;background-color: #ecf0f5;display: none">
            <!-- 页面内容 -->
            <section class="content" >
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">申请工单</h3>
                    </div>
                    <form action="{{route('admin.myOrder.apply.add')}}" method="post" role="form">

                        {!! csrf_field()!!}

                        <div class="box-body">
                            <div class="form-group">
                                <label for="applicant">申请人</label>
                                <input type="text" class="form-control" id="applicant" placeholder="申请人" name="applicant" required="required">
                            </div>

                            <div class="form-group">
                                <label for="phone">联系方式</label>
                                <input type="text" class="form-control" id="phone" placeholder="联系方式" name="phone" required="required">
                            </div>
                            <div class="form-group">
                                <label for="name_order">设备名称</label>
                                <input type="text" class="form-control" id="name_order" placeholder="设备名称" name="name_order" required="required">
                            </div>
                            <div class="form-group">
                                <label for="place">维修地点</label>
                                <input type="text" class="form-control" id="place" placeholder="维修地点" name="place" required="required">
                            </div>
                            <div class="form-group">
                                <label for="fault">故障信息</label>
                                <textarea name="fault" class="form-control" id="fault"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="departments_applicants">所属部门</label>
                                <input type="text" class="form-control" id="departments_applicants" name="departments_applicants" required="required" >
                            </div>
                            <div class="form-group">
                                <label for="deadline">最终维修完成时间要求</label>
                                <input type="text" class="form-control" id="deadline" name="deadline" value="" placeholder="yyyy-MM-dd HH:mm:ss">
                            </div>
                            <div class="form-group">
                                <label for="date_application">申请日期</label>
                                <input type="text" class="form-control" id="date_application" name="date_application" value="" readonly>
                            </div>



                            <div class="form-group">
                                <label for="danger">缓急程度</label>&nbsp;&nbsp;
                                <div class="checkbox" >
                                    <label>
                                        <input type="radio" name="danger" value="加急" onclick="intend()" >加急&nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="designated_personel">是否指定维修人员</label>&nbsp;&nbsp;

                                <div class="checkbox" >
                                    <label>
                                        <input type="radio" name="designated_personel" value="是" required onclick="isNot()" >是&nbsp;&nbsp;
                                        <input type="radio" name="designated_personel" value="否" required onclick="disappear()">否
                                    </label>
                                </div>
                            </div>
                            <div class="form-group" style="display: none" id="mainname">
                                <label for="maintenance">维修人员</label>
                                <input type="text" class="form-control" id="maintenance_personnel" name="maintenance_personnel"
                                       placeholder="维修人员" >
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        {{--        <!-- 用户退回工单页面 -->--}}
        {{--        <div class="modal fade" id="back-modal">--}}
        {{--            <div class="modal-dialog">--}}
        {{--                <div class="modal-content">--}}
        {{--                    <div class="modal-header">--}}
        {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
        {{--                            <span aria-hidden="true">&times;</span></button>--}}
        {{--                        <h4 class="modal-title">退回工单</h4>--}}
        {{--                    </div>--}}
        {{--                    <div class="modal-body">--}}
        {{--                        <form role="form" method="post" action="{{'/myOrder/back'}}">--}}
        {{--                            {{ csrf_field() }}--}}
        {{--                            <input type="text" class="form-control update-order-id" name="id">--}}
        {{--                            <input name="id" type="text" class="form-control update-order-id"  id="id"value="{{ old('id') }}">--}}
        {{--                            <div class="box-body">--}}

        {{--                                <div class="form-group">--}}
        {{--                                    <label for="reason">退回原因</label>--}}
        {{--                                    <textarea name="reason" class="form-control update-order-reason " id="reason"></textarea>--}}
        {{--                                </div>--}}

        {{--                            </div>--}}
        {{--                            <!-- /.box-body -->--}}

        {{--                            <div class="box-footer">--}}
        {{--                                <button type="submit" class="btn btn-primary submit">提交</button>--}}
        {{--                            </div>--}}
        {{--                        </form>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <!-- /.modal-content -->--}}
        {{--            </div>--}}
        {{--            <!-- /.modal-dialog -->--}}
        {{--        </div>--}}
        {{--        <!-- /.modal -->--}}
    </div>
    </body>
@stop
