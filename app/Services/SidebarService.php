<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SidebarService
{
    public static function getMenus()
    {
//        $adminId = Auth::id();
//
//        $admin = \App\Services\AdminService::getAdminById($adminId);
//        if (empty($admin)) {
//            return redirect()->route('loginPage');
//        }

//        $adminType = $admin->type;//1admin,2餐厅管理员

        //menu
        $menus = [
            [
                'type' => '1,2',
                'name' => '用户列表',
                'url' => route('admin.users.list'),
            ],
            [
                'type' => '1,2',
                'name' => '配置管理',
                'menus' => [
                    [
                        'name' => '用户列表',
                        'url' => route('admin.users.list'),
                    ],

                ]
            ],
        ];

//        foreach ($menus as $k => $menu) {
//            $type = $menu['type'];
//            $typeArr = explode(',', $type);
//            if (!in_array($adminType, $typeArr)) {
//                unset($menus[$k]);
//            }
//        }

        return $menus;
    }

}