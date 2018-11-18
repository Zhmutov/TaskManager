<?php
/**
 * Created by PhpStorm.
 * User: Витя
 * Date: 07.11.2018
 * Time: 20:12
 */
namespace App;

use Illuminate\Database\Eloquent\Model;


class Users_information extends Model
{
    public $timestamps = false;
    public function scopeGetInf($query,$userid)
    {
        $array=$query->where('user_id', $userid)->get()->toArray();
        return $array[0];
    }


//Добавляем новую запись в Инфо
    public function scopeAddUserInf($query, $userid , $fio, $country, $city, $birthDate)
    {
        $query->insert(['user_id' => $userid,
                            'FIO' => $fio,
                'country' => $country,
                'city' => $city,
                'birth_date' => $birthDate
        ]);
    }

//Список всех пользователей
    public function scopeGetAllUsersInf($query)
    {
        return $query->join('users', 'users_informations.user_id','=','users.user_id')
            ->join('role','users.role_id','=','role.role_id')
            ->select('users.*','users_informations.*','role.*')
            ->orderBy('inform_id');
    }
//информация по одному пользователю
    public function scopeGetOneUsersInf($query, $informid)
    {
        return $query->where('inform_id',$informid)->get()->ToArray();
    }

    //Изменяем запись в Users_Information
    public function scopeUpdUserInf($query, $informid, $fio, $country, $city, $birthDate)
    {
        $query->where('inform_id',$informid)->update(['FIO' => $fio,
            'country'=> $country,
            'city'=>$city,
            'birth_date'=>$birthDate
        ]);
    }

}