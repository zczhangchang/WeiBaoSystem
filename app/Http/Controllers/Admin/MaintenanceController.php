<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller{


    /*
     * 维修人员界面显示
     * */
    public function getMaintenance(Request $request)
    {

        return view('admin.user.maintenance');



    }


    
    /*
     * 维修人员列表显示
     * 
     * */
    public function getShowMaintenance(Request $request)
    {
        $id = $request->input('id');

        $where = new \App\Models\User;

        if($id){
            $where = $where->where('id', $id);

        }

        $users = DB::select('select * from user where role = ?',['维修人员']);

        return view('admin.user.maintenance', compact(['users','id']));



        
    }



    /*
     * 维修人员删除
     * */
    public function postMaintenanceDelete(Request $request)
    {

        $UserId = trim($request->input('id'));


        //dd($id);
        $res = \App\Services\AdminService::deleteUser($UserId);
        //dd($res);
        if (empty($res)) {

            //return '删除数据成功';
            return $this->resJson(0, '删除失败');

        }

        return $this->resJson(1, '删除成功');




    }



}
