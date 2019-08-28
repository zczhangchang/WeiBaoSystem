<?php

namespace App\Services;

class MyOrderService{


    //申请工单
    public static function addApply($applicant, $phone, $name_order,  $place, $fault,
                                    $departments_Applicants, $designated_personel,$maintenance_personnel,$date_application,$deadline,$danger){

        $order = new \App\Models\Order();
        $order->applicant              = $applicant;
        $order->phone                  = $phone;
        $order->name_order             = $name_order;
        $order->place                  = $place;
        $order->fault                  = $fault;
        $order->deadline               = $deadline;
        $order->departments_applicants = $departments_Applicants;
        $order ->designated_personel   = $designated_personel;
        $order ->maintenance_personnel =$maintenance_personnel;
        $order->date_application       = $date_application;
        $order->danger                 =$danger;
        $order->save();

        return $order;



    }

//    退回工单(更新数据)
//    public static function backOrder($reason)
//    {
//        $order = new \App\Models\Order();
//
//        $order->reason = $reason;
//        $order->save();
//
//        //dd($order);
//
//        return $order;
//
//    }

        public static function backOrder($id, $data)
    {

        //dd($data);

       // return \App\Models\Order::where('reason',$reason)->update(
        return \App\Models\Order::where('id',$id)->update(
            [
                'id' =>$data['id'],
                'reason' =>$data['reason']

                ]);

    }







}
