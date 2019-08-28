<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplyController extends Controller
{


    /*
     * 显示我的工单信息
     * */
    public function getMyorder()
    {


        return view('admin.order.ApplyOrder');
    }

    /*
     *我的工单数据库信息的显示
     *
     * */

    public function getShowMyOrder(request $request){

        $name = $request->input('name');

        $where = new \App\Models\Order;
        //dd($where);
        if ($name) {
            $where = $where->where('name', $name);
        }
        $orders = Order::where('id','>',0)->paginate(5);

        //dd($order);

        return view('admin.order.ApplyOrder',compact(['orders','name']));


    }


    /*
     * 申请工单
     * */
    public function postApplyAdd(Request $request){

        $applicant             = trim($request->input('applicant'));
        $phone                 = trim($request->input('phone'));
        $nameOrder             = trim($request->input('name_order'));
        $place                 =trim($request->input('place'));
        $fault                 =trim($request->input('fault'));
        $departmentsApplicants = trim($request->input('departments_applicants'));
        $designatedPersonel    = trim($request->input('designated_personel'));
        $maintenancePersonnel  = trim($request->input('maintenance_personnel'));
        $dateApplication       = trim($request->input('date_application'));
        $deadline              = trim($request->input('deadline'));
        $danger                =trim($request->input('danger'));

        //dd($request->all());



        if (empty($applicant) && empty($phone) && empty($place) && empty($deadline)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '添加用户信息不能为空');
            return redirect()->route('admin.order.ApplyOrder');

        }

        $res = \App\Services\MyOrderService::addApply($applicant, $phone, $nameOrder,  $place, $fault,
            $departmentsApplicants, $designatedPersonel, $maintenancePersonnel, $dateApplication,$deadline,$danger);
        //dd($res);
        //dd($created_at);
        if (empty($res)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '添加用户出错');
            return redirect()->route('admin.myOrder.show.list');
        }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', '添加用户成功');
        return redirect()->route('admin.myOrder.show.list');




    }

    /*
     * 工单退回
     * */

//    public function postBackOrder(Request $request){
//
//
//        $id = trim($request->input('id'));
//        $applicant = trim($request->input('applicant'));
//        $phone = trim($request->input('phone'));
//        $place = trim($request->input('place'));
//        $state = trim($request->input('state'));
//        $reason = trim($request->input('reason'));
//
//        //dd($reason);
//        $res = \App\Services\MyOrderService::backOrder($reason);
//
//        //dd($id);
//
//        if (empty($res)) {
//            $request->session()->flash('message.level', 'danger');
//            $request->session()->flash('message.content', '退回工单申请失败！');
//            return redirect()->route('admin.myOrder.show.list');
//        }
//            $request->session()->flash('message.level', 'success');
//            $request->session()->flash('message.content', '退回工单申请成功！');
//            return redirect()->route('admin.myOrder.show.list');
//
//    }



    public function postBackOrder(Request $request){


        $id = trim($request->input('id'));
        $reason = trim($request->input('reason'));

        //dd($reason);


        $data = [

            'reason' => $reason,
            'id' => $id

        ];


        $res = \App\Services\MyOrderService::backOrder($reason, $data);

       // dd($res);

        if (empty($res)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '退回工单申请失败！');
            return redirect()->route('admin.myOrder.show.list');
        }
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '退回工单申请成功！');
            return redirect()->route('admin.myOrder.show.list');

    }





}
