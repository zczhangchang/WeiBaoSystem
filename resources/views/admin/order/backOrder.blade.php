<!-- 退回工单页面 -->
@extends('admin.layouts.app')
@section('pageTitle','退回工单')
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

    <!-- 编辑数据-->
    <script>
        // $('.update').on('click', function () {
        //     var id = $(this).data('id');
        //     $('.update-order-id').val(id);
        //
        //     var reason=$(this).data('reason')
        //     $('.update-order-reason').val(reason);
        // });
        // $('no').on('click',function () {
        //    var id=$(this).data('id');
        //     $('.update-order-id').val(id);
        //
        // });
        $('.yes').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('checkOrder') }}', {
                id: id,
            })
                .then(function (response) {
                    console.log(response);
                    var data = response.data;


                })
                .catch(function (error) {
                    console.log(error);
                    $('.top-right').notify({
                        message: {text: '退回工单成功'},
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
    <body class="sidebar-mini skin-blue">
    <div class="wrapper">
        <div id="list" class="content-wrapper" style="min-height: 976px;background-color: #ecf0f5;display: block">
            <!-- 页面标题 -->
            <section class="content-header" style="height: 50px">
                <h1 style="float: left;padding-top: 8px"><b>
                        退回工单审核
                    </b></h1>
            </section>
            <section class="content" >
                <div class="row">

                    <div class="col-xs-10">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><b>退回工单</b></h3>
                            </div>
                            <div class="box-body no-padding">
                                <form class="" method="get" action="{{'/backOrder/list'}}" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">
                                    <table class="table table-striped" style="font-size: 18px;text-align: center">
                                        <tbody><tr>
                                            <th style="text-align: center">#</th>
                                            <th style="text-align: center">申请人</th>
                                            <th style="text-align: center">联系方式</th>
                                            <th style="text-align: center">维修地址</th>
                                            <th style="text-align: center">状态</th>
                                            <th style="text-align: center">操作</th>
                                        </tr>


                                        @foreach($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->applicant}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->place}}</td>

                                            <td>
                                            @if($order['state']==0)
                                                <span class="badge bg-blue">正在退回</span></td>
                                            @endif
                                            @if($order['state']==0)
                                            <td>
                                              <span class="badge btn bg-light-blue yes"
                                              data-id="{{$order['id']}}">
                                            同意退回</span>
                                            </td>
                                            @else
                                            <td><span>  </span></td>
                                            @endif
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

{{--        <!-- 管理员审核退回工单页面 -->--}}
{{--        <div class="modal fade" id="update-modal">--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="modal-header">--}}
{{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                            <span aria-hidden="true">&times;</span></button>--}}
{{--                        <h4 class="modal-title">审核</h4>--}}
{{--                    </div>--}}
{{--                    <div class="modal-body">--}}
{{--                        <form role="form" method="post" action="{{'/backOrder/list'}}">--}}
{{--                            {{ csrf_field() }}--}}
{{--                            <input type="hidden" class="form-control update-order-id" name="id">--}}
{{--                            <div class="box-body">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label for="reason">退回原由</label>--}}
{{--                                    <textarea class="form-control update-order-reason" id="reason" name="reason"--}}
{{--                                    value="{{ old('reason') }}" readonly></textarea>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <div class="box-footer">--}}
{{--                                <button type="submit" class="btn btn-primary" id="yes">同意退回</button>--}}
{{--                                <button type="submit" class="btn btn-primary" id="no">拒绝退回</button>--}}
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

