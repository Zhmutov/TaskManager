<?php
include_once 'User.php';



$cheack = new TaskManager\User();
$login = 'Vik';
$password = '1234';
$res = $cheack->cheackUser($login, $password);
if ($res == 0) {
    $cheack->addNewUser($login, $password);
}else{
    $a = $cheack->addInformation($login, $password, 'Zhmutov', 'Viktor', 'Aleksandrovich', 'Ukraine', 'Kiev', '1988-08-12');
  //  var_dump($a);
}
echo $res;
