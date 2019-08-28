<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


    /*
     * 展示展示工单管理
     *工单列表
     * */
    public function getOrderPage(request $request)
    {


        return view('admin.order.dispachList');


    }

    /*
     * 数据库中数据,工单列表显示列表
    */
    public function getShowOrder(request $request)
    {
        $id = $request->input('id');
       // dd($id);
        //dd($status);
        $where = new \App\Models\Order();

        //dd($where);
        if ($id) {
            $where = $where->where('id', $id);
        }
        $orders = Order::where('id','>=','1')->paginate(5);

        return view('admin.order.dispachList', compact(['orders', 'id']));

    }

    /*
     * 状态下拉框
     * */
    public function postStatus(Request $request)
    {

        $status = $request->input('status');
        $data['status'] = DB::table('status')->simplePaginate(5);

        //dd($status);
        $where = new \App\Models\Status();
        if ($status) {
            $where = $where->where('status', $status);
        }
        //$statuses=DB::table('status')->get();
        $statuses = DB::table('status')->get();

        //dd($statuses);

        return view('admin.order.dispachList',['status' =>$statuses]);


    }




            /*按条件查询
             * */
    public function postSelect(Request $request)
    {
        $params = [];
        $search = $request->input('Order');
        if(!empty($search['applicant'])) {
            $conditions[] = ' applicant = :applicant ';
            $params[':applicant'] = $search['applicant'];
        }
        if(!empty($search['maintenance_personnel'])) {
            $conditions[] = ' maintenance_personnel = :maintenance_personnel ';
            $params[':maintenance_personnel'] = $search['maintenance_personnel'];
        }
        if(!empty($search['state'])) {
            $conditions[] = 'state = :state';
            $params[':state'] = $search['state'];
        }
        if(!empty($search['departments_applicants'])) {
            $conditions[] = ' departments_applicants  = :departments_applicants  ';
            $params[':departments_applicants '] = $search['departments_applicants'];
        }
        if(!empty($search['date_application'])) {
            $conditions[] = ' date_application = :date_application ';
            $params[':date_application'] = $search['date_application'];
        }

        // dd($applicant);
       //$orders = Order::where('applicant','=', '小青')->paginate(3);
        //dd($orders);
        $orders = Order::whereRaw(implode('and', $conditions), $params)->paginate(4);

        //dd($orders);

        return view('admin.order.dispachList',
            ['orders' => $orders,
            ]);






      }


          /*
           * 工单状态的设置
           * */
    public function postGiveOrder(Request $request)
          {
              $orderId = $request->input('id');

              $res = \App\Services\OrderService::changeOrderStatus($orderId, 2);
              if (empty($res)) {
                  return $this->resJson(0, '失败');
              }
              return $this->resJson(1, '成功');
          }


    public function postSubmitOrder(Request $request)
    {
        $orderId = $request->input('id');

        $res = \App\Services\OrderService::changeOrderStatus($orderId, 0);
        if (empty($res)) {
            return $this->resJson(0, '失败');
        }
        return $this->resJson(1, '成功');
    }

        public function postBackOrder(Request $request)
        {
            $orderId = $request->input('id');

            $res = \App\Services\OrderService::changeOrderStatus($orderId, 0);
            if (empty($res)) {
                return $this->resJson(0, '失败');
            }
          return $this->resJson(1, '成功');



              if ($applicant) {
                  $where = $where->where('applicant',$applicant);

              }
//              $orders = DB::table('order')->select('id','name_order','order_place','date_application',
//              'designated_personel','departments_applicants','state','applicant','maintenance_personnel')->get();

              $orders = Order::select('id','applicant');
              //dd($orders);


              return view('admin.order.dispachList', compact(['orders',  'applicant']));


          }











    //返回工单列表
    public function getdetails(){


        return redirect()->back();
    }

}
