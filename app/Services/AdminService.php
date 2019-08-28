<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 2019-06-13
 * Time: 22:19
 */

namespace App\Services;

class AdminService
{

    public static function getAdminById($id)
    {
        return $admin = \App\Models\Admin::where('id', $id)->first();
    }

    public static function getAdmin($name, $password)
    {
        $user = \App\Models\Admin::where('name', $name)
            ->where('password', $password)
            ->first();

        return $user;
    }

    public static function getUser($name, $password)
    {
        $user = \App\Models\Admin::where('name', $name)
            ->where('password', $password)
            ->first();

        return $user;
    }

    public static function getUserById($userId)
    {
        return $user= \App\Models\User::where('id', $userId)->first();
    }

    public static function getUsers()
    {
        return \App\Models\User::where('name', '!=', 'user')->get();
    }

    public static function addUser($name, $password, $phone, $address, $role)
    {
        //dd($role);
        $user = new \App\Models\User;
        $user->name = $name;
        $user->password = $password;
        $user->phone = $phone;
        $user->address = $address;
        $user->role = $role;
        $user->save();


        return $user;
    }

    public static function updateUser($id, $data)
    {
        return \App\Models\User::where('id', $id)->update(
            [
                'id' =>$data['id'],
                'name' => $data['name'],
                'password' => $data['password'],
                'phone' => $data['phone'],
                'address' => $data['address']
            ]);
    }

    public static function deleteUser($id)
    {
        return \App\Models\User::where('id', $id)->delete();
    }



}
