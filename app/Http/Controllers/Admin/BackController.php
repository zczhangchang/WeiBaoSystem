<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;


class BackController extends Controller{

        /*
         *退回工单界面
         * */
    public function getBackOrder(Request $request){

        return view('admin.order.backOrder');




    }
//审核同意
    public function postCheckOrder(Request $request)
    {
        $orderId = $request->input('id');

        $res = \App\Services\OrderService::changeOrderStatus($orderId, 1);
        if (empty($res)) {
            return $this->resJson(0, '失败');
        }
        return $this->resJson(1, '成功');
    }



    /*
     * 退回工单列表显示
     * */

    public function getBackOrderList(Request $request)
    {

        $data['orders'] = DB::table('order')->simplePaginate(5);

        $id = $request->input('id');
        $applicant = $request->input('applicant');
        $phone = $request->input('phone');
        $place = $request->input('place');
        $state = $request->input('state');



        //dd($place);

        $where = new \App\Models\Order;

        //dd($where);

        if($id){
            $where = $where->where('id',$id);

        }
        if($applicant){
            $where = $where->where('applicant',$applicant);

        }
        if($phone){
            $where = $where->where('phone',$phone);

        }

        if($place){
            $where = $where->where('place',$place);

        }
        if($state){
            $where = $where->where('place',$state);

        }

        //$orders = DB::select('select * from order where applicant = ?',['小张']);

        //$orders = Order::select('select * from order where state = ?', array(0));
        $orders = Order::where('id','>=',1)->paginate(5);

        //dd($orders);


        return view('admin.order.backOrder', compact(['orders','id' ,'applicant', 'phone', 'place','state']));



    }


    //审核 退回理由
    public function postBackOrder(Request $request){

        $id = $request->input('id');
        $reason = $request->input('reason');

        $where = new \App\Models\Order;

        if($id){

            $where = $where->where('id',$id);

        }

        if($reason){

            $where = $where->where('reason',$reason);

        }

       // $orders = DB::select('select * from order where reason = ?',array(1));
        $orders = Order::all();

        return view('admin.order.backOrder', compact(['orders','id' ,'reason']));

    }

}
