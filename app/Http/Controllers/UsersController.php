<?php
/**
 * Created by PhpStorm.
 * User: vgalatin
 * Date: 03.11.2018
 * Time: 13:27
 */

namespace App\Http\Controllers;

use App\User as Users;
use App\Users_information as UserInf;

//use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function authorization()
    {
        $usercheck = Users::Authuser();
        $count = $usercheck->count();
        if ($count == 1) {
            $userarray = $usercheck->get()->toArray();
            $user = $userarray[0];
            unset($user['password']);
            $userinf = UserInf::Getinf($user['user_id']);
            session($user);
            session($userinf);
            $fio = $userinf['FIO'];
            session(['message' => "$fio, вы успешно авторизировались"]);
            return view('deffault');
        } else {
            session(['login' => $_POST['login']]);
            session(['message' => 'ошибка в данных']);
            return redirect()->route('auth');
        }
    }

 //Создание Логина и Добавления Информации для пользователя
    public function usersInfoCreate()
    {
        $usercheck = Users::Authuser();
        $count = $usercheck->count();
        if ($count >> 0) {
            session(['login' => $_POST['login']]);
            session(['message' => 'Пользователь с логином "' . $_POST['login'] . '" уже создан!']);
            return redirect()->route('auth');
        } else {
            //Создать пользователя в таблице Users
            Users::AddUser($_POST['login'], $_POST['password'], $_POST['role']);
            //Забрать User_id только что созданного пользователя
            $userarray = $usercheck->get()->toArray();
            $user = $userarray[0];
            session($user);
            session(['user_id' => $user['user_id']]);
            //Заполнить информацию о пользователи и записать в таблицу Users_informations
            UserInf::AddInf(session()->get('user_id'), $_POST['FIO'], $_POST['country'], $_POST['city'], $_POST['birthDate']);

            session(['message' => $_POST['FIO'] . ', информация добавлена']);
            return view('deffault');
        }
    }
//Список пользователей
    public function usersList()
    {
        $usercheck = UserInf::AllUsersInf();
        $userarray = $usercheck->get()->toArray();
        $user = $userarray;
        session(['users' => $user]);
        return view('deffault', ['inf' => 'usersList']);
    }
//Информация о пользователе
    public function getUpdUsersInf()
    {

    }

}