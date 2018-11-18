<?php
/**
 * Created by PhpStorm.
 * User: Витя
 * Date: 25.10.2018
 * Time: 21:14
 */

namespace App\Http\Controllers;




use Illuminate\Http\Request;

class UserConrtoller extends Controller
{

//    public function show($id)
//    {
//        return 'User '.$id;
//    }

    public function hide()
    {
        return 'Hide!';
    }

    public function su()
    {
        return view('user');
    }

    public function start()
    {
            return view('createUser');
    }
//Работ а с request (HTTP)
    public function create(Request $request)
    {
//        var_dump($request->path()).PHP_EOL;
////        var_dump($request->url()).PHP_EOL;
////        var_dump($request->fullUrl()).PHP_EOL;
////        $userName = $request->input('username');
////        var_dump($userName);
///
        if ($request->isMethod('get')) {
            return view('user_create');
        }

        return redirect()
            ->route('show_user', ['id' => 100])
            ->with('info', 'User created!');



    }
    public function show($id)
    {
        return view('user_show',['id'=> 33]);
    }

    public function showForm()
    {
        return view('user');
    }
}