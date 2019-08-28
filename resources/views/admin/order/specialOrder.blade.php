<!-- 特派工单 -->
@extends('admin.layouts.app')

@section('pageTitle','维护派单系统—特派工单')

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
        $('.details').on('click',function () {
            var id = $(this).data('id');
            $('.details-dispach-id').val(id);

            var applicant = $(this).data('applicant');
            $('.details-dispach-applicant').val(applicant);

            var place = $(this).data('place');
            $('.details-dispach-place').val(place);

            var fault=$(this).data('fault');
            $('.details-dispach-fault').val(fault);

            var phone = $(this).data('phone');
            $('.details-dispach-phone').val(phone);
        });
    </script>
@stop

@section('pageContent')
    <body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper" id="list" style="min-height: 976px; background-color: #ecf0f5;
            display: block">
            <section class="content-header" style="height: 50px">
                <h1 style="float: left; padding-top: 8px">
                    <b>特派工单</b>
                </h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>特派工单列表</b></h3>
                            </div>
                            <div class="box-body no-padding">
                                <div class="box-body">
                                    <div class="row">
                                        <form class="" action="{{'/dispach/select'}}" method="post">

                                            {!! csrf_field() !!}
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>申请人:</label>
                                                    <input type="text" class="form-control" name="Order[applicant]"
                                                    id="applicant" value="{{Request('Order')['applicant']}}">
                                                </div>
                                            </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>维修人员:</label>
                                                        <select name="Order['maintenance_personnel']" class="form-control" id="maintenance_personnel">
                                                            <option value="maintenance_personnel">全部</option>
                                                            <option value="maintenance_personnel">小张</option>
                                                            <option value="maintenance_personnel">小李</option>
                                                            <option value="maintenance_personnel">小王</option>
                                                            <option value="maintenance_personnel">赵六</option>
                                                            <option value="maintenance_personnel">田七</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <button class="btn btn-primary form-control" type="submit">查询</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>

                                <form class="" method="post" action="{{'/dispach/list'}}" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">
                                    <table class="table table-striped" style="font-size: 18px">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th style="text-align: center">申请人</th>
                                            <th style="text-align: center">维修人员</th>
                                            <th style="text-align: center">故障信息</th>
                                            <th style="text-align: center">联系方式</th>
                                            <th style="text-align: center">维修地址</th>
                                            <th style="text-align: center">状态</th>
                                            <th style="text-align: center">缓急情况</th>
                                            <th style="text-align: center">操作</th>
                                        </tr>




                                        @foreach($orders as $order)
                                        <tr style="text-align: center">
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->applicant}}</td>
                                            <td>{{$order->maintenance_personnel}}</td>
                                            <td>{{$order->fault}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->place}}</td>
{{--                                            <td>{{$order->state}}</td>--}}
                                                @if($order['state']==2)
                                                <td><span class="badge bg-yellow">已派单</span></td>
                                                    @else
                                                <td><span class="badge bg-green">无状态</span></td>
                                                    @endif
                                            <td><span class="badge bg-red">{{$order->danger}}</span></td>

                                            <td>
                                        <span class="badge btn bg-light-blue details"
                                              data-id="{{$order['id']}}"
                                              data-applicant="{{$order['applicant']}}"
                                              data-place="{{$order['place']}}"
                                              data-fault="{{$order['fault']}}"
                                              data-phone="{{$order['phone']}}"
                                              data-target="#details-modal" data-toggle="modal">
                                            查看详情</span>
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

        <!-- 查看详情跳转页面 -->
        <div class="modal fade" id="details-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">特派工单详情</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="get" action="">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control details-dispach-id" name="id">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>申请人:</label>
                                    <input type="text" class="form-control details-dispach-applicant" name="applicant"
                                           placeholder="申请人" value="{{ old('applicant') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>维修地址:</label>
                                    <input type="text" class="form-control details-dispach-place" name="place"
                                    placeholder="维修地址" value="{{old('place')}}" readonly>
                                </div>

                                <div class="form-group">
                                    <label>故障信息:</label>
                                    <input type="text" class="form-control details-dispach-fault" name="fault"
                                    placeholder="故障信息" value="{{old('fault')}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>联系方式:</label>
                                    <input type="text" class="form-control details-dispach-phone" name="phone"
                                    placeholder="联系方式" value="{{old('phone')}}" readonly>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary" onclick="back()">返回</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
                            <!-- /.box-body -->

    </body>
@stop
