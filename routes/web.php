<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    session(['action' => 'start']);
    return view('deffault');
})->name('start');//стартовый
Route::get('/authorization', function () {
    return view('deffault', ['inf' => 'authorization']);
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
    return view('deffault', ['inf' => 'createtask']);
})->middleware('noauth');

Route::post('/task/create', function (Request $request) {
    return view('deffault', ['inf' => 'testform']);
})->middleware('noauth')->name('create');

Route::get('/task/my', function () {
    return view('deffault', ['inf' => 'testform']);
})->middleware('noauth');

Route::get('/task/forme', function () {
    return view('deffault', ['inf' => 'testform']);
})->middleware('noauth');

Route::get('/admin', function () {
    session(['action'=>'admin']);
    return view('deffault');
})->middleware('noauth');

//Через панель "Админ меню" заполняем информацию о юзере.

Route::get('/admin/create', function () {
    return view('deffault', ['inf' => 'usersCreate']);

});

Route::post('/admin/create', 'UsersController@usersInfoCreate')->name('usersCreate');

//Список пользователей
//Route::get('/admin/userslist', function () {
//    return view('deffault', ['inf' => 'usersList']);
//});
Route::get('/admin/userslist', 'UsersController@usersList')->name('usersList');

//Изменяем информацию о пользователях
Route::get('/admin/update', 'UsersController@usersUpdate')->name('usersUpdate');


//Route::get('/', function () {
//    session(['action' => 'start']);
//    return view('deffault');
//})->name('start');//стартовый
//
//Route::get('/authorization', function () {
//    return view('deffault', ['inf' => 'authorization']);
//})->name('auth');
//
//Route::post('/authorization', 'UsersController@authorization');
//
//
//Route::get('/exit', function () {
//    session(['user_id' => '']);
//    session(['role_id' => '']);
//    session(['FIO' => '']);
//    session(['message'=>'']);
//    session(['login'=>'']);;
//    return redirect()->route('start');
//});
//Route::get('/task', function () {
//    session(['action'=>'task']);
//    return view('deffault');
//})->middleware('noauth');
//
//Route::get('/task/create', function () {
//    return view('deffault', ['inf' => 'createtask']);
//});
//Route::post('/task/create', function (Request $request) {
//
//    var_dump($_POST);
//})->name('create');


//Через панель "Админ меню" заполняем информацию о юзере.

//Route::get('/admin/create', function () {
//    return view('deffault', ['inf' => 'usersCreate']);
//});
//
//Route::post('/admin/create', 'UsersController@usersCreate')->name('usersCreate');





