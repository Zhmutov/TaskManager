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
use Illuminate\Http\Request;
use DateTime;
use DateInterval;
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
            //unset($user['password']);
            $userinf = UserInf::Getinf($user['user_id']);
            session($user);
            session($userinf);

//Проверка на первый вход
            $firstEnter = $user['first_enter'];
            if ($firstEnter == 1) {
                //var_dump($user[session()->get('password', '')]);
                $params = ['inf' => 'changePassword', 'nextinf' => ['']];
                return view('deffault', $params);
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
    public function usersInfoCreate(Request $request)
    {
        $this->validate($request, [
            'login' => 'required|unique:users,login',
            'password' => 'required|min:6',
            'FIO' => 'required',
            'country' => 'required',
            'city' => 'required',
            'birthDate' => 'required',
            'birthDate' => 'required|date|before:now-18year',
         ], [
             'login.required' => 'Не заполнен Логин!',
         'login.unique' => 'Логин "'.$_POST['login'].'" уже есть, создайте другой!',
         'password.required' => 'Не заполнен Пароль!',
         'password.min' => 'Слишком короткий пароль, должен быть больше 6 символов!',
         'FIO.required' => 'Не заполнено ФИО!',
         'country.required' => 'Не заполнена Страна!',
         'city.required' => 'Не заполнен Город!',
        'birthDate.required' => 'Не заполнена Дата Рождения!',
         'birthDate.before' => 'Пользователю нету 18, дата должна быть меньше!',
            ]
            );

                $usercheck = Users::Authuser();

                //Создать пользователя в таблице Users
                Users::AddUser($_POST['login'], $_POST['password'], $_POST['role']);
                //Забрать User_id только что созданного пользователя
                $userarray = $usercheck->get()->toArray();
                $user = $userarray[0];
                //Заполнить информацию о пользователи и записать в таблицу Users_informations
                UserInf::AddUserInf($user['user_id'], $_POST['FIO'], $_POST['country'], $_POST['city'], $_POST['birthDate']);
//Выведем сообщения
                session(['message' => $_POST['FIO'] . ', информация добавлена']);
        return redirect()->route('usersList');
                //return view('deffault');
        }
//Список пользователей
    public function getUsersList()
    {
        $allUser = UserInf::GetAllUsersInf()->paginate(5);
        $allUser = ['allUser' => $allUser];
        return view('deffault', ['inf' => 'usersList', 'nextinf' => $allUser]);
    }
//Информация о пользователе
    public function getOneUsersInf($inform_id)
    {
        $oneUserInfCheck = Userinf::GetOneUsersInf($inform_id);
        $infoArray = $oneUserInfCheck{0};
        $user = Users::GetUserByUserId($infoArray['user_id']);
        $oneUserCheck = ['user' => $user{0}, 'oneUserInfCheck' => $oneUserInfCheck{0}];
        return view('deffault', ['inf' => 'usersCreate', 'nextinf' => $oneUserCheck]);
    }
//Изменяем информацию о пользователе
    public function updateOneUsersInf(Request $request, $informid)
    {

        $this->validate($request, [
            'login' => 'required',
            'password' => 'required|min:6',
            'FIO' => 'required',
            'country' => 'required',
            'city' => 'required',
            'birthDate' => 'required',
            'birthDate' => 'required|date|before:now-18year',
        ], [
                'login.required' => 'Не заполнен Логин!',
                'password.required' => 'Не заполнен Пароль!',
                'password.min' => 'Слишком короткий пароль, должен быть больше 6 символов!',
                'FIO.required' => 'Не заполнено ФИО!',
                'country.required' => 'Не заполнена Страна!',
                'city.required' => 'Не заполнен Город!',
                'birthDate.required' => 'Не заполнена Дата Рождения!',
                'birthDate.before' => 'Пользователю нету 18, дата должна быть меньше!',
            ]
        );

            $oneUserInfCheck = Userinf::GetOneUsersInf($informid);
            $infoArray = $oneUserInfCheck[0];
            Users::UpdUser($infoArray['user_id'],$_POST['login'],$_POST['password'],$_POST['role']);
            UserInf::UpdUserInf($informid, $_POST['FIO'], $_POST['country'], $_POST['city'], $_POST['birthDate']);
//Выведем сообщения
            session(['message' => 'По '.$_POST['FIO'] . ', информация изменена!']);
            return view('deffault');
    }
// Изменим пароль при первом входе
    public function changePassword()//Request $request)
    {
      //  var_dump(session()->get('user_id'));
        if (strlen($_POST['password']) < 6) {
            session(['message' => "Новый пароль меньше 6 символов, повторите попытку!"]);
            return redirect()->route('changePassword');
        }elseif ($_POST['confirmed_password']<> $_POST['password']) {
            session(['message' => "Не верно ввели новый пароль, повторите попытку!"]);
            return redirect()->route('changePassword');
        }elseif ($_POST['oldPassword']==$_POST['confirmed_password']){
            session(['message' => "Новый и старый пароли совпадаю, повторите попытку!"]);
            return redirect()->route('changePassword');
        }
        Users::ChangePassword(session()->get('user_id'),$_POST['confirmed_password']);
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