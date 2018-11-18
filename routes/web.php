<?php
use Illuminate\Http\Request;


Route::get('/', function () {
    session(['action' => 'start']);
    return view('deffault');
})->name('start');//стартовый
Route::get('/authorization', function () {
    return view('deffault', ['inf' => 'authorization', 'nextInf'=>[]]);
})->name('auth');
Route::post('/authorization', 'UsersController@authorization');
Route::get('/exit', function () {
    session(['user_id' => '']);
    session(['role_id' => '']);
    session(['FIO' => '']);
    session(['message'=>'']);
    session(['login'=>'']);;
    return redirect()->route('start');
});

Route::get('/task', function () {
    session(['action'=>'task']);
    return view('deffault');
})->middleware('noauth');

Route::get('/task/create', function () {
    return view('deffault', ['inf' => 'createtask', 'nextInf'=>[]]);
})->middleware('noauth');

Route::post('/task/create', function (Request $request) {
    return view('deffault', ['inf' => 'testform', 'nextInf'=>[]]);
})->middleware('noauth')->name('create');

Route::get('/task/my', function () {
    return view('deffault', ['inf' => 'testform', 'nextInf'=>[]]);
})->middleware('noauth');

Route::get('/task/forme', function () {
    return view('deffault', ['inf' => 'testform', 'nextInf'=>[]]);
})->middleware('noauth');

Route::get('/admin', function () {
    session(['action'=>'admin']);
    return view('deffault');
})->name('admin');


//Через панель "Админ меню" заполняем информацию о юзере.
Route::get('/admin/create', function () {
    return view('deffault', ['inf' => 'usersCreate', 'nextInf'=>[]]);
});
//Добавить Изера и информацию о нем
Route::post('/admin/create', 'UsersController@usersInfoCreate')->name('usersCreate');

//Список пользователей
Route::get('/admin/userslist', 'UsersController@getUsersList')->name('usersList');

//Заполняем информацию о пользователе, используем get запрос
Route::get('/admin/create/{inform_id}', 'UsersController@getOneUsersInf')->name('oneUsersInf');
//Изменяем информацию о пользователе, используем post запрос
Route::post('/admin/create/{inform_id}', 'UsersController@updateOneUsersInf')->name('updateOneUsersInf');


Route::get('/changePassword', function () {
    return view('deffault', ['inf' => 'changePassword', 'nextInf'=>[]]);
})->name('changePassword');
Route::post('/changePassword', 'UsersController@changePassword');



