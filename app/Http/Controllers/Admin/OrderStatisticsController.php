<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;

class OrderStatisticsController extends Controller
{

    /*
     * 显示任务统计界面
     * */

    public function getOrderStatistics(Request $request)
    {
        $applicant= $request->input('applicant');




//        $orders = DB::table('order')
//            ->select('SELECT COUNT(applicant) FROM `order`');

        $where = new \App\Models\Order();

        //dd($where);
        $orders = DB::table('order')
            ->where('applicant',$applicant)
            ->count('applicant');

       // dd($orders);

        return view('admin.order.Order');

    }

    /*
     * 显示任务统计的结果：工单总量、待维修和完成合计
     * */

//    public function getSelectNoResult(Request $request)
//    {
//        $id = $request->input('id');
//        $where = new \App\Models\Order();
//
//        if($id){
//            $where = $where->where('id', $id);
//        }
//        $orders = DB::table('order')
//        ->whereRaw('state = ?', [1])
//            ->get();
//        //dd($orders);
//
//        return view('admin.order.orderStatistics', compact(['orders','id']));





    /*
     * 显示任务统计的结果：工单总量、待维修和完成合计
     * */
//
//    public function getSelectNoResult(Request $request)
//    {
//        $id = $request->input('id');
//
//        $where = new \App\Moder\Order();
//
//        if($id){
//            $where = $where->where('id',$id);
//        }
//
//        $orders = DB::table('order')
//            ->select('SELECT COUNT(applicant) FROM `order`');
//
//       // dd($orders);



















   public function getSelectNoResult(Request $request){

       $id = $request->input('id');
        $where = new \App\Models\Order();

        if($id){
            $where = $where->where('id', $id);
        }

               $Orders =DB::table('order')
            ->where('state','=',1)
            ->groupBy('maintenance_personnel')
            ->select(DB::raw("sum(state) as d"))
            ->get();
        //dd($Orders);

        return view('admin.order.orderStatistics', compact(['orders','id']));


   }

}
