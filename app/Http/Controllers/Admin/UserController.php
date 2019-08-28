<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{


    /**
     * 展示用户列表
     */

    public function getListPage(Request $request)
    {
        $name = $request->input('name');
        /*
         * 权限的处理
         * */
//        $id = Auth::id();
//        $admin = \App\Services\AdminService::getAdminById($id);
//        //dd($admin);
//        if (empty($admin)) {
//            $request->session()->flash('message.level', 'danger');
//            $request->session()->flash('message.content', '获取用户信息失败,请联系管理员');
//
//
//        }


        $where = new \App\Models\User;
        if ($name) {
            $where = $where->where('name',$name);

        }
        $users = User ::where('id', '>=',1)->paginate(5);
        //dd($users);


        return view('admin.user.list', compact(['users',  'name']));
    }









    /**
     * 新增用户
     *
     */

    public function postAdd(Request $request)
    {
        $id = trim($request->input('id'));
        $name = trim($request->input('username'));
        $password = trim($request->input('password'));
        $phone = trim($request->input('phone'));
        $address = trim($request->input('address'));
        $role = trim($request->input('role'));

        if (empty($name) || empty($password)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '添加用户信息不能为空');
            return redirect()->route('admin.user.list_page');

        }

        $users = DB::table('user')->where('name', $name)->first();

        if (!empty($users)) {

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '添加用户已经存在，不可重复添加！');
            return redirect()->route('admin.user.list_page');
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '添加用户成功！');
            $res = \App\Services\AdminService::addUser($name, $password, $phone, $address, $role);
            return redirect()->route('admin.user.list_page');
        }

    }













    /*
     *
     * 用户编辑
     * */
    public function getUpdate(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $password = $request->input('password');
        $phone = $request->input('phone');
        $address = $request->input('address');

        if (empty($name) || empty($password) ||empty($phone)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '用户填写信息不能为空');
            return redirect()->route('admin.users.list');
        }

        $data = [
            'id'=> $id,
            'name' => $name,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
        ];
        //dd($data);

        $res = \App\Services\AdminService::updateUser($id, $data);
          //$res = \App\Models\User::update($id, $data);

        if (empty($res)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '修改失败');
            return redirect()->route('admin.user.list_page');
        }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', '修改成功');
        return redirect()->route('admin.user.list_page');
    }



    /*
     * 单个用户删除
     * */

    public function postDelete(Request $request)
    {

        $userId = $request->input('id');
        $res = \App\Services\AdminService::deleteUser($userId);
        //dd($res);
        if (empty($res)) {

            //return '删除数据成功';
            return $this->resJson(0,'删除失败');

        }

        return $this->resJson(1, '删除成功');
    }







     /*
      *
      * 批量删除用户
      * */
    public function postDeleteMore(Request $request){

        //$username=session()->get('username');
        //echo $username;die;
        $id=$request->input('id');
//        $id=ltrim($id,",");
        $ar=explode(",",$id);

        $res=DB::table('user')->whereIn('id',$ar)->delete();
        //print_r($res);die;

        if($res){
            //dd($res);

            echo "ok";
        }else{
            echo "no";
        }

    }



    /**
     * 登出界面
     */
    public function getLogout(Request $request)
    {
        return redirect('/auth/login');




    }


}
