<!-- 维修人员页面 -->
@extends('admin.layouts.app')
@section('pageTitle','维护派单系统—维修人员')
@section('pageStyle')
<style>

</style>
@stop
@section('pageScript')
    <script src="//cdn.bootcss.com/axios/0.18.0/axios.min.js"></script>
<script>

    //维修人员删除
    $('.delete').on('click', function () {
        var id = $(this).data('id');
        axios.post('{{ route('admin.user.Maintenance.delete') }}', {
            id: id,
        })
            .then(function (response) {
                console.log(response);
                var data = response.data;


            })
            .catch(function (error) {
                console.log(error);
                $('.top-right').notify({
                    message: {text: '删除成功'},
                    type: 'success',
                    fadeOut: {enabled: true, delay: 1500},
                    onClose: function () {
                        window.location.reload();
                    }
                }).show();
            });
    });

    // $('.update').on('click', function () {
    //     var id = $(this).data('id');
    //     $('.update-admin-id').val(id);
    //
    //     var name = $(this).data('name');
    //     $('.update-admin-name').val(name);
    //
    //     var password = $(this).data('password');
    //     $('.update-admin-password').val(password);
    //
    //     var phone = $(this).data('phone');
    //     $('.update-admin-phone').val(phone);
    // });

</script>
@stop
@section('pageContent')
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper" id="list" style="min-height: 976px; background-color: #ecf0f5;
            display: block">
        <section class="content-header" style="height: 50px">
            <h1 style="float: left;padding-top: 8px"><b>
                    维修人员列表
                </b></h1>
        </section>
        <section class="content" >
            <div class="row">

                <div class="col-xs-10">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><b>维修人员</b></h3>
                        </div>
                        <div class="box-body no-padding">
                            <form class="" method="post" action="{{url('/maintenance/list')}}">
                                <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">

                                {!! csrf_field() !!}

                                <table class="table table-striped" style="font-size: 18px">
                                    <tbody><tr>
                                        <th>#</th>
                                        <th>id</th>
                                        <th>用户名</th>
                                        <th>密码</th>
                                        <th>角色</th>
                                        <th>联系方式</th>
                                        <th>创建时间</th>
                                        <th>操作</th>
                                    </tr>


                                    @foreach($users as $user)
                                    <tr>

                                        <td><input type="checkbox" value="{{$user->id}}" class="box11" name="box11" ></td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->password}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>

                                            <span class="badge btn bg-light-blue delete"
                                                 > 删除 </span>
                                        </td>
                                    </tr>

                                    @endforeach
                                    </tbody></table>

                            </form>
                        </div>
                        <!-- /.box-body -->

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- 维修人员编辑页面 -->
    <div class="modal fade" id="update-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">编辑</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="get" action="{{'/maintenance/list'}}">
                        {{ csrf_field() }}

                        <input type="hidden" class="form-control update-admin-id" name="id">
                        <div class="box-body">
                            <div class="form-group">
                                <label>用户名</label>
                                <input type="text" class="form-control update-admin-name" name="name"
                                       placeholder="用户名" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">联系方式</label>
                                <input type="text" class="form-control update-admin-phone" id="phone" name="phone" value="{{old('phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="password">密码</label>
                                <input type="password" class="form-control update-admin-password" id="password" name="password" value="{{old('password')}}">
                            </div>
                        </div>
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
