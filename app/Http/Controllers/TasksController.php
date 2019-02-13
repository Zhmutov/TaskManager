<?php
/**
 * Created by PhpStorm.
 * User: vgalatin
 * Date: 10.11.2018
 * Time: 23:38
 */

namespace App\Http\Controllers;

use App\Users_information as UserInf;
use App\Task as Task;
use App\Users_information as Inf;
//use http\Env\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    public function GetFormCreateTask($valuetext = '', $valuetitle = '')
    {
        $executors = UserInf::GetExecutor(session('user_id'));
        $executors = ['executors' => $executors, 'text' => $valuetext, 'title' => $valuetitle];
        $include = ['inf' => 'createtask', 'nextinf' => $executors];
        //var_dump($executors);
        //var_dump($executors);
        return view('deffault', $include);
    }

    public function PutTask(Request $request)
    {

//        var_dump($request);
//        exit();
        $this->validate($request, [
            'title' => 'required|max:150',
            'text' => 'min:20',
            'id_executor' => 'not_in:0'
        ], ['title.required' => 'Не заполнена тема',
            'title.max' => 'Тема не может сдержать более 150 символов',
            'text.min' => 'Текст задачи не может быть меньше 20символов',
            'id_executor.not_in' => 'Не выбран исполнитель']);

            Task::PutTask();
            return redirect('/task/forme');

    }

    public function ViewAllTaskforme()
    {
        session(['listaction' => '/task/forme']);

        $tasks = DB::table('tasks')
            // ->join('users_informations as b', 'tasks.creater_user_id', '=', 'b.user_id')
            ->join('users_informations as u', 'tasks.worker_user_id', '=', 'u.user_id')
            ->join('task_status as t', 'tasks.status_id', '=', 't.status_id')
            ->select('tasks.task_id', 'tasks.task_subject', 'u.FIO as worker', 'task_create', 'task_term', 'task_end', 'status_name')
            ->where('creater_user_id', session('user_id'))
            ->orderBy('task_create', 'desc')
            ->paginate(8);
        $array = ['inf' => 'listtasksforme', 'nextinf' => ['tasks' => $tasks]];

        return view('deffault', $array);
    }

    public function ViewAllTaskmy()
    {
        session(['listaction' => '/task/my']);
        $tasks = DB::table('tasks')
            ->join('users_informations as b', 'tasks.creater_user_id', '=', 'b.user_id')
            // ->join('users_informations as u', 'tasks.worker_user_id', '=', 'u.user_id')
            ->join('task_status as t', 'tasks.status_id', '=', 't.status_id')
            ->select('tasks.task_id', 'tasks.task_subject', 'b.FIO as creator', 'task_create', 'task_term', 'task_end', 'status_name')
            ->where('worker_user_id', session('user_id'))
            ->orderBy('task_term')
            ->paginate(8);
        $array = ['inf' => 'listtasksmy', 'nextinf' => ['tasks' => $tasks]];

        return view('deffault', $array);
    }

    public function Answertothetask($id)
    {
        session(['task_id' => $id,]);
        $oneTask = Task::ShowTask($id);
        $oneTask[0]['creater_FIO'] = Inf::GetFIO($oneTask[0]['creater_user_id']);
        $oneTask[0]['worker_FIO'] = Inf::GetFIO($oneTask[0]['worker_user_id']);
        //var_dump($oneTask[0]);
        $array = ['inf' => 'task', 'nextinf' => $oneTask[0]];
        return view('deffault', $array);
    }

    public function PutAnswerForTheTask()
    {


        Task::PutAnswer();
        return redirect("/task/" . session('task_id'));//->route('taskmy');
    }


}