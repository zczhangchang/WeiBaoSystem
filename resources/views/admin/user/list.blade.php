@extends('admin.layouts.app')


@section('pageTitle','用户列表')

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

        function create() {
            document.getElementById('list').style.display='none';
            document.getElementById('update').style.display='block';
        }

        //用户单行删除
        $('.delete').on('click', function () {
            var id = $(this).data('id');
            axios.post('{{ route('admin.user.delete') }}', {
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

        //批量删除
        $(".deletemore").click(function(){
            var obj=$(".box11");
            var str="";
            for(var i=0;i<obj.length;i++){
                if(obj.eq(i).prop("checked")==true){
                    var id=obj.eq(i).val();
                    var str=str+","+id;
                    //alert(i);

                }
            }
            //alert(id);
            if(confirm("您确定要批量删除吗？")){
                var _token="<?php echo csrf_token(); ?>";
                var send={_token:_token,id:str}
                var url="{{url('/user/deletemore')}}"
                $.post(url,send,function(data){
                    alert(data);
                    if(data=="ok"){
                        for(var i=0;i<obj.length;i++){
                            if(obj.eq(i).prop("checked")==true){
                                var id=obj.eq(i).val();
                                $("#d_"+id).remove();
                                window.location.reload();

                            }

                        }
                    }

                })
            }


        })

        //用户编辑

            $('.update').on('click', function () {
                var id = $(this).data('id');
                $('.update-admin-id').val(id);

                var name = $(this).data('name');
                $('.update-admin-name').val(name);

                var password = $(this).data('password');
                $('.update-admin-password').val(password);

                var phone = $(this).data('phone');
                $('.update-admin-phone').val(phone);

                var address = $(this).data('address');
                $('.update-admin-address').val(address);

                $('input:checkbox').each(function () {
                    $(this).attr('checked', false);
                });
            });

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
                        派单系统人员列表
                    </b></h1>
                <div style="width: 80px;height: 30px;float: left;padding-left: 10px;">
                    <button type="button" class="btn btn-block btn-success btn-lg" style="font-size: 16px" onclick="create()">新增</button></div>
                <div style="width: 80px;height: 30px;float: left;padding-left: 10px;">
                    <button type="button" class="btn btn-block btn-success btn-lg deletemore" style="font-size: 16px;width: 100px"onclick="">批量删除</button></div>
            </section>
            <!-- 页面内容 -->
            <section class="content" >
                <div class="row">

                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body no-padding">
                                <form class="" method="post" action="{{url('/user/list')}}" enctype="multipart/form-data">
                                    <input type="hidden" name="_method" value="PUT（PATCH、DELETE）">
                                    {{ csrf_field()}}
                                <table class="table table-striped" style="font-size: 18px">

                                    <tbody><tr>
                                        <th style="width: 30px"></th>
                                        <th style="text-align: center">序号</th>
                                        <th style="text-align: center">用户名</th>
                                        <th style="text-align: center">密码</th>
                                        <th style="text-align: center">角色</th>
                                        <th style="text-align: center">联系方式</th>
                                        <th style="text-align: center">地址</th>
                                        <th style="text-align: center">创建时间</th>
                                        <th style="text-align: center">更新时间</th>
                                        <th style="text-align: center">操作</th>
                                    </tr>


                                    @foreach($users as $user)



                                    <tr id="d_" style="text-align: center">
                                        <td><input type="checkbox" value="{{$user->id}}" class="box11" name="box11" ></td>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->password}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->updated_at}}</td>
                                        <td>
                                            <!--
                                            <div style="float: left;margin-left: 10px">
                                            <button type="button" class="btn btn-block btn-primary" style="width: 60px;font-size: 16px;padding: 5px 0px" onclick="Delete()" data-id="{{$user['id']}}">
                                            <b>删除</b></button></div>
                                            -->
                                                <span class="badge btn bg-light-blue update"
                                                      data-id="{{ $user['id'] }}"
                                                      data-name="{{ $user['name'] }}"
                                                      data-password="{{ $user['password'] }}"
                                                      data-phone="{{ $user['phone'] }}"
                                                      data-role="{{$user['role']}}"
                                                      data-address="{{ $user['address'] }}"
                                                      data-toggle="modal" data-target="#update-modal" >编辑</span>
                                                <span class="badge btn bg-light-blue delete"
                                                      data-id="{{ $user['id'] }}"> 删除 </span>
                                        </td>
                                    </tr>
                                        @endforeach


                                    </tbody></table>
                                </form>
                            </div>
                            <!-- /.box-body -->


                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!--用户新增页面  -->
        <div id="update" class="content-wrapper" style="min-height: 976px;background-color: #ecf0f5;display: none">
            <!-- 页面内容 -->
            <section class="content" >
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">新增用户</h3>
                    </div>
                    <form action="{{route('admin.user.add')}}" method="post" role="form">

                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input type="text" class="form-control" id="username" placeholder="用户名" name="username" >
                                <p style="color: red;display: none">该用户名已存在</p>
                            </div>
                            <div class="form-group">
                                <label for="Password">密码</label>
                                <input type="password" class="form-control" id="Password" placeholder="密码" name="password" >
                            </div>
                            <div class="form-group">
                                <label for="tel">联系方式</label>
                                <input type="tel" class="form-control" id="tel" placeholder="联系方式" name="phone" required>
                            </div>

                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" id="address" placeholder="地址" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="role">角色</label>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" name="role" value="普通用户" required>普通用户&nbsp;&nbsp;
                                        <input type="radio"name="role" value="超级管理员" required>超级管理员&nbsp;&nbsp;
                                        <input type="radio" name="role" value="维修人员" required>维修人员
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <!-- 用户修改编辑页面 -->


        <div class="modal fade" id="update-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">编辑用户信息</h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="get" action="{{route('admin.user.update')}}">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control update-admin-id" name="id">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>用户名:</label>
                                    <input type="text" class="form-control update-admin-name" name="name"
                                           placeholder="用户名" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label>密码:</label>
                                    <input type="text" class="form-control update-admin-password" name="password"
                                           placeholder="密码" value="{{ old('password') }}">
                                </div>

                                <div class="form-group">
                                    <label>联系方式:</label>
                                    <input type="tel" class="form-control update-admin-phone"
                                           placeholder="联系方式" name="phone" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                    <label>地址:</label>
                                    <input type="text" class="form-control update-admin-address"
                                           placeholder="地址" name="address" value="{{ old('address') }}">
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
