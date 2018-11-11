
<center><p><h3><strong><a href="/">Главная</a></strong></h3></p></center>
<?php
$i = session()->get('role_id',0);
switch ($i) {
    case 1:
        echo "<center><p><h3><strong><a href='/task'>Задачи</a></h3></p></center>" .PHP_EOL;
        if ((session()->get('action','') == 'task')) {
            echo "<p align ='right'><h4><strong><a href='/task/create'>Создать задачу</a></strong></h4></p>" .PHP_EOL;
            echo "<p align ='right'><h4><strong><a href='/task/my'>Мои задачи</a></strong></h4></p>" .PHP_EOL;
            echo "<p align ='right'><h4><strong><a href='/task/forme'>Отправленые мной</a></strong></h4></p>" .PHP_EOL;
        }
        break;
    case 2:
        echo "<center><p><h3><strong><a href='/task'>Задачи</a></strong></h3></p></center>" .PHP_EOL;
        if ((session()->get('action','') == 'task')) {
            echo "<div align =\"right\"><h4><strong><a href='/task/create'>Создать задачу</a></strong></h4></div>" .PHP_EOL;
            echo "<div align ='right'><strong><h4><a href='/task/my'>Мои задачи</a></strong></h4></div>" .PHP_EOL;
            echo "<div align ='right'><strong><h4><a href='/task/forme'>Отправленые мной</a></strong></h4></div>" .PHP_EOL;
        }
        echo "<center><p><h3><strong><a href='/admin'>Админ меню</a></strong></h3></p></center>" .PHP_EOL;
        if ((session()->get('action','') == 'admin')) {
            echo "<div align =\"right\"><h4><strong><a href='/admin/create'>Создать Пользователя</a></strong></h4></div>" .PHP_EOL;
            echo "<div align ='right'><strong><h4><a href='/admin/userslist'>Все Пользователи</a></strong></h4></div>" .PHP_EOL;
        }
        break;

}; ?>



