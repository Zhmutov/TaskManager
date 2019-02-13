<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    session(['action' => 'start']);
    return view('deffault');
})->name('start');//стартовый

Route::get('/authorization', function () {
    $params = ['inf' => 'authorization', 'nextinf' => ['']];
    return view('deffault', $params);
})->name('auth');

Route::post('/authorization', 'UsersController@authorization');
//Route::post('/authorization', 'UsersController@authorization1');

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

Route::get('/task/create', 'TasksController@GetFormCreateTask')->middleware('noauth');


Route::post('/task/create','TasksController@PutTask')->middleware('noauth')->name('creates');

route::get('/test', function () {
    $time = '+ 2 Hour';
    $date = new DateTime($time,new DateTimeZone('Europe/kiev'));
    echo $date->format("Y-m-d H:i:s");

});



Route::get('/task/forme', 'TasksController@ViewAllTaskforme')->middleware('noauth');
Route::get('/task/my', 'TasksController@ViewAllTaskmy')->middleware('noauth')->name('taskmy');
Route::post('/task/id', 'TasksController@PutAnswerForTheTask')->middleware('noauth')->name('putanswer');
Route::get('/task/{id}', 'TasksController@Answertothetask')->middleware('noauth');




Route::get('/registration', function () {
    return view('deffault', ['inf' => 'testform']);
});

Route::get('/admin', function () {
    session(['action'=>'admin']);
    return view('deffault');
})->name('admin');
//Через панель "Админ меню" заполняем информацию о юзере.
Route::get('/admin/create', function () {
    return view('deffault', ['inf' => 'usersCreate', 'nextinf'=>['']]);
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
    return view('deffault', ['inf' => 'changePassword', 'nextinf'=>[]]);
})->name('changePassword');
Route::post('/changePassword', 'UsersController@changePassword');


//Test Images
Route::resource('/images','ImageController');

Route::get('upload',['as' => 'upload_form', 'uses' => 'UploadController@getForm']);
Route::post('upload',['as' => 'upload_file','uses' => 'UploadController@upload']);


