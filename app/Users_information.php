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
    public function scopeAddInf($query, $userid , $fio, $country, $city, $birthDate)
    {
        $query->insert(['user_id' => $userid,
                            'FIO' => $fio,
                'country' => $country,
                'city' => $city,
                'birth_date' => $birthDate
        ]);
    }

//Список всех пользователей
    public function scopeAllUsersInf($query)
    {
        return $query->where([['user_id', '<>', '0']]);
    }
//информация по одному пользователю
    public function scopeUpdUsersInf($query, $inform_id)
    {
        return $query->where('inform_id',$inform_id)->get()->ToArray();
    }

}