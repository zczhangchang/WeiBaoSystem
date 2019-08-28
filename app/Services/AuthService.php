<?php
/**
 * Created by PhpStorm.
 * User: cynhard
 * Date: 2019-03-17
 * Time: 22:19
 */

namespace App\Services;

class AuthService
{
    public static function check($name, $password)
    {
        $user = \App\Models\User::where('name', $name)
            ->where('password', $password)
            ->first();

        if (empty($user)) {
            return false;
        }

        return true;
    }

}
