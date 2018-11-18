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
            $userarray = $usercheck->get()->toArray(0);
            $user = $userarray[0];

            $userinf = UserInf::Getinf($user['user_id']);
            session($user);
            session($userinf);
            //Проверка на первый вход
            $firstEnter = $user['first_enter'];
            if ($firstEnter == 1) {
                return view('deffault',['inf' => 'changePassword', 'nextInf' => []]);
            }else{
                $fio = $userinf['FIO'];
                session(['message' => "$fio, вы успешно авторизировались"]);
                return view('deffault');
            }

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
            session(['message' => 'Пользователь с логином "' . $_POST['login'] . '" уже создан!']);
            return redirect()->route('admin');
        } else {
            $birthday = strtotime($_POST['birthDate']);
            $age = date('Ymd') - date('Ymd', $birthday);
            if ($age < 180000 ) {
                session(['message' => 'Не возможно создать пользователя,'.$_POST['FIO'].' ему еще нету 18!']);
                return redirect()->route('usersCreate');
            }else{
            //Создать пользователя в таблице Users
            Users::AddUser($_POST['login'], $_POST['password'], $_POST['role']);
            //Забрать User_id только что созданного пользователя
            $userarray = $usercheck->get()->toArray();
            $user = $userarray[0];
            //Заполнить информацию о пользователи и записать в таблицу Users_informations
            UserInf::AddUserInf($user['user_id'], $_POST['FIO'], $_POST['country'], $_POST['city'], $_POST['birthDate']);
//Выведем сообщения
            session(['message' => $_POST['FIO'] . ', информация добавлена']);
            return view('deffault');
            }
        }
    }

//Список пользователей
    public function getUsersList()
    {
        $allUser = UserInf::GetAllUsersInf()->paginate(5);
        $allUser = ['allUser' => $allUser];

        return view('deffault', ['inf' => 'usersList', 'nextInf' => $allUser]);
    }

//Информация о пользователе
    public function getOneUsersInf($inform_id)
    {
        $oneUserInfCheck = Userinf::GetOneUsersInf($inform_id);
        $infoArray = $oneUserInfCheck{0};
        $user = Users::GetUserByUserId($infoArray['user_id']);

        $oneUserCheck = ['user' => $user{0}, 'oneUserInfCheck' => $oneUserInfCheck{0}];
        return view('deffault', ['inf' => 'usersCreate', 'nextInf' => $oneUserCheck]);
    }
//Изменяем информацию о пользователе
    public function updateOneUsersInf($informid)
    {
        //Проверка на возраст.
        $birthday = strtotime($_POST['birthDate']);
        $age = date('Ymd') - date('Ymd', $birthday);
        if (($age < 180000)) {
            $message = 'Не возможно изменить дату рождения! Пользователю,'.$_POST['FIO'].' будет меньше 18!';
            session(['message' => $message]);
            return redirect()->route('oneUsersInf', ['inform_id' => $informid]);
        }else{
        $oneUserInfCheck = Userinf::GetOneUsersInf($informid);
        $infoArray = $oneUserInfCheck[0];
        Users::UpdUser($infoArray['user_id'],$_POST['login'],$_POST['password'],$_POST['role']);
        UserInf::UpdUserInf($informid, $_POST['FIO'], $_POST['country'], $_POST['city'], $_POST['birthDate']);
//Выведем сообщения
        session(['message' => 'По '.$_POST['FIO'] . ', информация изменена!']);
        return view('deffault');}
    }
// Изменим пароль при первом входе
    public function changePassword()
    {
        var_dump(session()->get('user_id'));
        if ($_POST['newPassword']<> $_POST['password']) {
            session(['message' => "Не верно ввели новый пароль, повторите попытку!"]);

            return redirect()->route('changePassword');
        }elseif ($_POST['oldPassword']==$_POST['newPassword']){
            session(['message' => "Новый и старый пароли совпадаю, повторите попытку!"]);
            return redirect()->route('changePassword');
        }
        Users::ChangePassword(session()->get('user_id'),$_POST['newPassword']);

        $usercheck = Users::Authuser();
        $userarray = $usercheck->get()->toArray(0);
        $user = $userarray[0];
        session($user);
        unset($user['password']);
        $userinf = UserInf::Getinf($user['user_id']);
        $fio = $userinf['FIO'];
        session(['message' => "Пароль изменен. $fio, вы успешно авторизировались"]);
        return view('deffault');
    }
}