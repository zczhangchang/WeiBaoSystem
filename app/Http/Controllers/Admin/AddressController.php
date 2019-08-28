<?php

namespace App\Http\Controllers\Admin;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{


    /*
     *报修地点设置
     * */

    public function getAddress(Request $request)
    {

        return view('admin.address.address');

    }


    /*
     * 显示报修地点设置列表
     * */

    public function getShowAddress(Request $request)
    {

        $id = $request->input('id');
        //dd($id);
        $where = new \App\Models\Address;
        //dd($where);

        if ($id) {
            $where = $where->where('id', 'like', '%' . $id . '%');

        }
        $addresses = Address::where('id','>=','1')->paginate(5);
//        dd($address);


        return view('admin.address.address', compact(['addresses', 'id']));

    }

    /*
     * 新增报修地点
     * */
    public function postAddAddress(Request $request)
    {
        //dd($request->input('name'));
        //dd($request->input('contacts'));
        //dd($request->input('beizhu'));

        $id = trim($request->input('id'));
        $name = trim($request->input('name'));
        $beizhu = trim($request->input('beizhu'));
        $contacts = trim($request->input('contacts'));


        if (empty($name) || empty($beizhu) || empty($contacts)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '添加用户信息不能为空');
            return redirect()->route('admin.show.address.list');

        }

        $res = \App\Services\AddressService::addAddress($name, $beizhu, $contacts);
        //dd($res);
        if (empty($res)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '添加用户出错');
            return redirect()->route('admin.show.address.list');
        }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', '添加用户成功');
        return redirect()->route('admin.show.address.list');

    }


    /*
     * 删除数据
     * */

    public function postDeleteAddress( Request $request )
    {

        $AddressId = trim($request->input('id'));


        //dd($id);
        $res = \App\Services\AddressService::deleteAddress($AddressId);
        //dd($res);
        if (empty($res)) {

            //return '删除数据成功';
            return $this->resJson(0, '删除失败');

        }

        return $this->resJson(1, '删除成功!');

    }






    /*
     * 修改
     * */

    public function getUpdateAddress(Request $request)
    {

        $id = $request->input('id');
        $name = $request->input('name');
        $beizhu = $request->input('beizhu');
        $contacts = $request->input('contacts');
        //dd($id);
        //dd($name);
        //dd($contacts);

        if (empty($name)  || empty($beizhu) || empty($contacts)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '用户填写信息不能为空');
            return redirect()->route('admin.show.address.list');
        }

        $data = [
            'id' => $id,
            'name' => $name,
            'beizhu' => $beizhu,
            'contacts' => $contacts,
        ];
        //dd($data);

        $res = \App\Services\AddressService::updateAddress($id, $data);
        //dd($res);

        if (empty($res)) {
                       $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', '修改失败');
            return redirect()->route('admin.show.address.list');

        }
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', '修改成功');
        return redirect()->route('admin.show.address.list');



    }
}
