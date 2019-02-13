<?php
/**
 * Created by PhpStorm.
 * User: vgalatin
 * Date: 03.11.2018
 * Time: 13:52
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model

{

    public $timestamps = false;

    public function scopeAuthuser($query)
    {
        return $query->where([['login', '=', $_POST['login']], ['password', '=', $_POST['password']]]);
    }

    //Добавляем новую запись в Users
    public function scopeAddUser($query, $login, $password, $role)
    {
        $query->insert(['login' => $login,
            'password'=> $password,
            'role_id'=>$role
        ]);
    }
//Найдем запись в Users по user_id
    public function scopeGetUserByUserId($query,$userid)
    {
        return  $query->where('user_id', $userid)->get()->toArray();
    }
    //Изменяем запись в Users по user_id
    public function scopeUpdUser($query, $userid, $login, $password, $role)
    {
        $query->where('user_id',$userid)->update(['login' => $login,
            'password'=> $password,
            'role_id'=>$role
        ]);
    }
    //Изменяем пароль в Users по user_id
    public function scopeChangePassword($query, $userid, $password)
    {
        $query->where('user_id',$userid)->update(['first_enter'=>0,'password'=> $password]);
    }

}