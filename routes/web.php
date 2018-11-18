<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return 'About page';
});


//Route::get('user/{id?}', function ($id = 0) {
//    return 'User '.$id;
//});

Route::post('post', function ($params) {
    return 'POST';
});

Route::get('show/{id}', 'UserConrtoller@show');
Route::get('hide', 'UserConrtoller@hide');

Route::get('su', 'UserConrtoller@su');


Route::get('show-user', function () {
    return view('user');
});

Route::get('login/{login?}/pass{pass?}', function ($login = 're', $pass = 12){

    if ($login == 'adm' && $pass = '123') {
        return view('createUser');
    } else {
        echo 'User';
    }

});

Route::get('login/{login?}/password{password?}', 'UserConrtoller@tests');

Route::get('start', function () {

    session_start();

    $_SESSION['username'] = "Viktor";
    return view('createUser',['userName'=> $_SESSION['username'],
        'Surname'=>'Zhmutov']);

 });


//Route::get('/user', 'UserConrtoller@showForm');
//Route::post('/user', 'UserConrtoller@create');

Route::match(['get', 'post'], '/user', 'UserConrtoller@create');

Route::get('/user{id}', 'UserConrtoller@show')->name('show_user');


Route::get('test', function () {
    print_r(array_combine(array(1, 2, 3, 6), array(4, 5, 6 )));
}

);





