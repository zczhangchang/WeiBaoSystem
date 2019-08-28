<!-- 报修地点设置 -->
@extends('admin.layouts.app')


@section('pageTitle','维护派单系统—报修地点设置')

@section('pageStyle')
    <style>
        .daohangl{
            float: left;
            padding: 15px 15px 10px;
        }
    </style>
    <style>
        .badge.btn {
            cursor: pointer;
        }
    </style>
@stop
@section('pageScript')
    <script src="//cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
    <script>


        function create() {
            document.getElementById('list').style.display='none';
            document.getElementById('update').style.display='block';
        }


        //修改
        $('.update').on('click', function () {
            var id = $(this).data('id');
            $('.update-admin-id').val(id);

            var name = $(this).data('name');
            $('.update-admin-name').val(name);

            var beizhu = $(this).data('beizhu');
            $('.update-admin-beizhu').val(beizhu);


            var contacts = $(this).data('contacts');
            $('.update-admin-contacts').val(contacts);
        });


        //单个删除
        $('.delete').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('admin.address.delete') }}', {
                id: id,
            })
                .then(function (response) {
                    console.log(response);
                    var data = response.data;


                })
                .catch(function (error) {
                    console.log(error);
                    $('.top-right').notify({
                        message: {text: '删除成功!'},
                        type: 'success',
                        fadeOut: {enabled: true, delay: 1500},
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
                        报修地点设置
                    </b>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add-modal">
                        新增报修地点
                    </button></h1>
            </section>
            <section class="content" >
                <div class="row">

                    <div class="col-xs-10">
                        <div class="box">
                            <div class="box-body no-padding">
                                <div class="box-body">
                                    <div class="row">
                                        <form class="" method="post" action="{{url('/address/list')}}">
                                            {!! csrf_field() !!}
                                            <div class="col-md-6">
                                                <div class="form-group" style="padding-top: 5px">
                                                    <label id="font">地点类型:</label>&nbsp;&nbsp;
                                                    <select name="address" class="select" id="address">
                                                        <option value="address1">华东电脑—1号楼</option>
                                                        <option value="address2">华东电脑—2号楼</option>
                                                        <option value="address3">华东电脑—3号楼</option>
                                                        <option value="address4">舜泰广场—6号楼</option>
                                                        <option value="address5">舜泰广场—11号楼</option>
                                                        <option value="address6">舜泰广场—1号楼</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <form class="" method="post" action="{{url('/address/list')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">
                                    <table class="table table-striped" style="font-size: 18px">
                                        <tbody><tr>
                                            <th>#</th>
                                            <th>序号</th>
                                            <th>名称</th>
                                            <th>备注</th>
                                            <th>联系人</th>
                                            <th>操作</th>
                                        </tr>


                                        @foreach($addresses as $address)

                                        <tr>
                                            <td><input type="checkbox" value="{{$address->id}}" class="box11" name="box11" ></td>
                                            <td>{{$address->id}}</td>
                                            <td>{{$address->name}}</td>
                                            <td>{{$address->beizhu}}</td>
                                            <td>{{$address->contacts}}</td>
                                            <td>
                                            <span class="badge btn bg-light-blue delete"
                                           data-id="{{$address['id']}}"
                                             onclick="if (confirm('确定删除吗？') == false) return false;">删除</span>
                                                <span class="badge btn bg-light-blue update" data-toggle="modal"
                                                      data-id="{{ $address['id'] }}"
                                                      data-name="{{ $address['name'] }}"
                                                      data-beizhu="{{ $address['beizhu'] }}"
                                                      data-contacts="{{ $address['contacts'] }}"
                                                      data-target="#update-modal">修改</span>
                                            </td>
                                        </tr>
                                            @endforeach
                                        </tbody></table>
                                </form>
                            </div>
                            {{$addresses->links()}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- 新增 -->
        <div class="modal fade" id="add-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">新增</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" action="{{url('/address/add')}}">
                            {!! csrf_field() !!}
                            <div class="box-body">
                                <div class="form-group">
                                    <label>名称:</label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="名称" value="">
                                </div>
                                <div class="form-group">
                                    <label>备注：</label>
                                    <input type="text" class="form-control" name="beizhu"
                                           placeholder="备注" value="">
                                </div>
                                <div class="form-group">
                                    <label>联系人：</label>
                                    <input type="text" class="form-control" name="contacts"
                                           placeholder="联系人" value="">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- 修改 -->
        <div class="modal fade" id="update-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">修改</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="get" action="{{url('/address/update')}}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <input type="hidden" value="{{old('id')}}"class="form-control update-admin-id" name = "id">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>名称:</label>
                                    <input type="text" class="form-control update-admin-name" name="name"
                                           placeholder="名称" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <label>备注：</label>
                                    <input type="text" class="form-control update-admin-beizhu" name="beizhu"
                                           placeholder="备注" value="{{old('beizhu')}}">
                                </div>
                                <div class="form-group">
                                    <label>联系人：</label>
                                    <input type="text" class="form-control update-admin-contacts" name="contacts"
                                           placeholder="联系人" value="{{old('contacts')}}">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
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
