<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * 登录页面
     */
    public function getLoginPage(Request $request)
    {
        return view('admin.auth.login1');
    }

    /**
     * 登出界面
     */
    public function getLogout(Request $request)
    {

        return redirect('/auth/login');



    }

    /**
     * 登录
     */
    public function postLogin(Request $request)
    {

        $name = $request->input('name');
        $password = $request->input('password');

        // 判断提交的登录信息
        if (($name == '') || ($password == '')) {
            // 若为空
            return redirect()->back();
        }
        $user = User::where('name',$name)->where('password',$password)->first();

        //dd($password);
        if(empty($user)||(empty($password))){
            $request->session()->flash('message.level', 'error');
            $request->session()->flash('message.content', '密码或用户名未填写');
            //return redirect()->route('admin.auth.message');
            return view('admin.auth.error');

            //return redirect()->route('admin.auth.login')->with('登录失败');


          //echo "填写信息错误,请重新填写";
          exit();

        }


        //Auth::login($user);

        return redirect('/myOrder/list');



    }



}
