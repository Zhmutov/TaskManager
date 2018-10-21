<?php

namespace TaskManager;

use PDO;

include_once 'DataBase.php';

class User extends DataBase
{
//Проверка при входе
    public function cheackUser($login, $password)
    {
        $query = $this->getDb()->prepare("select count(*) as col from users where login = :login and password = :password");
        $query->bindValue('login', $login, PDO::PARAM_STR);
        $query->bindValue('password', $password, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchColumn();
        return $result;
        //Если нету пользователя - создадим его
//        if (!isset($result)) {
//            $this->addNewUser($login, $password);
//        }
    }

//Создание Логина
    public function addNewUser($login, $password)
    {
        $query = $this->getDb()->prepare("insert into users (login, password, first_enter) values (:login, :password, :first_enter)");
        $query->bindValue('login', $login, PDO::PARAM_STR);
        $query->bindValue('password', $password, PDO::PARAM_STR);
        $query->bindValue('first_enter', 1, PDO::PARAM_STR);
        $query->execute();
    }

//Заполняем и записываем доп информацию.
    public function addInformation($login, $password, $name, $surname, $patronymic, $country, $city, $birthDate)
    {
        $FIO = "$name $surname $patronymic";
        $query = $this->getDb()->prepare("
insert into users_information (user_id, FIO, country, city, birth_date) 
select user_id, :FIO, :country, :city, :birthDate
from users 
where login = :login and password = :password");
        $query->bindValue('login', $login, PDO::PARAM_STR);
        $query->bindValue('password', $password, PDO::PARAM_STR);
        $query->bindValue('FIO', $FIO, PDO::PARAM_STR);
        $query->bindValue('country', $country, PDO::PARAM_STR);
        $query->bindValue('city', $city, PDO::PARAM_STR);
        $query->bindValue('birthDate', $birthDate, PDO::PARAM_STR);
        $query->execute();
    }

    public function addRole($userID, $roleID)
    {
        $query = $this->getDb()->prepare("update users set role_id = :roleID where user_id = :userID");
        $query->bindValue('roleID', $roleID, PDO::PARAM_INT);
        $query->bindValue('userID', $userID, PDO::PARAM_INT);
        $query->execute();
    }

}