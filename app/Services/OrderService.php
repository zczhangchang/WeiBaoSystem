<?php
namespace App\services;



use App\Models\Order;

class OrderService{

    public static function changeOrderStatus($id, $state)
    {
        return \App\Models\Order::where('id', $id)->update(
            [
                'state' => $state,
            ]
        );
    }


    public static function checkOrderNoExists($order)
    {
        $order = \App\Models\Order::where('order', $order)->first();

        if (empty($order)) {
            return false;
        }
        return true;
    }

    public static function getOrderByOrderNo($order)
    {
        $order = \App\Models\Order::where('order', $order)->first();
        return $order;
    }

    public static function getOrderByOrderRawNo($orderRawNo)
    {
        $order = \App\Models\Order::where('order', $orderRawNo)->first();
        return $order;
    }

    public static function changeOrderNoStatus($order, $status)
    {
        $order = \App\Models\Order::where('order', $order)->update(['status' => $status]);
        return $order;
    }

    public static function updateBalance($order, $newOrder)
    {
        return \App\Models\Order::where('order', $order)->update(['order' => $newOrder]);
    }

    public static function getOrderByOrderNos(array $ids)
    {
        return \App\Models\Order::whereIn('order', $ids)->get();
    }

    public static function updateIc($id, array $data)
    {
        return \App\Models\Order::where('id', $id)->update($data);
    }



    //查询
    public function selectOrder($id,$applicant,$maintenance_personnel,$designated_personel,$departments_applicants)
    {

        return \App\Models\Order::where('id',$id)->select($id,$applicant,$maintenance_personnel,$designated_personel,$departments_applicants);

    }



    function findByParam($param = array())
    {

//     $date_applicantion = $request->input('date_applicantion');
        $select = new Order();
        if (isset($param['applicant']) && '' != $param['applicant']) {
            $select = $select->where('order.applicant', '=', $param['applicant']);
        }
        if (isset($param['maintenance_personnel']) && '' != $param['maintenance_personnel']) {
            $select = $select->where('order.maintenance_personnel', '=', $param['maintenance_personnel']);
        }
        if (isset($param['state']) && '' != $param['state']) {
            $select = $select->where('order.state', '=', $param['state']);
        }
        if (isset($param['departments_applicants']) && '' != $param['departments_applicants']) {
            $select = $select->where('order.departments_applicants', '=', $param['departments_applicants']);
        }
        if (isset($param['date_application']) && '' != $param['date_application']) {
            $select = $select->where('order.date_application', '=', $param['date_application']);
        }
        $orders = $select->leftJoin("order", function ($join) {
            $join->on("applicant", "=", "applicant");
        })
            ->get(array(
                'departments_applicants',
                'applicant',
                'maintenance_personnel',
                'state',
                'date_applicantion'
            ));

        $order = \App\Models\Order::where('order', $orders)->first();

        return  json_encode($orders);
    }

    public static function select($id,$applicant,$maintenance_personnel,$departments_applicants,$state,$data)
    {
        return \App\Models\Order::where('id', $id)->select(
            [
                'applicant' => $data['applicant'],
                'maintenance_personnel' => $data['maintenance_personnel'],
                'departments_applicants' => $data['departments_applicants'],
                'state' => $data['state']
            ]);

    }


    //状态下拉框
    public static function getOrders(){

        return \App\Models\Status::where('status', 2)->get();
    }




    }
