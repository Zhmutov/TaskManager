<?php
/**
 * Created by PhpStorm.
 * User: vgalatin
 * Date: 11.11.2018
 * Time: 12:18
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Support\Facades\DB;

class Task extends Model
{
    public $timestamps = false;

    public function scopePutTask($query)
    {
        Switch ($_POST['id_prioriti']) {
            case 1:
                $term = '+ 1 Hour';
                break;
            case 2:
                $term = '+ 4 Hour';
                break;
            case 3:
                $term = '+ 1 Day';
                break;
            case 4:
                $term = '+ 4 Days';
                break;
            case 5:
                $term = '+ 7 Days';
                break;
            case 6:
                $term = '+ 1 Month';
                break;
            default:
                $term = '+ 1 Year';

        }

        $task_create = new \DateTime('', new \DateTimeZone('europe/kiev'));
        $task_term = new \DateTime($term, new \DateTimeZone('europe/kiev'));

        $query->insert(['worker_user_id' => $_POST['id_executor'],
            'creater_user_id' => session('user_id'),
            'status_id' => 1,
            'task_subject' => $_POST['title'],
            'task_body' => $_POST['text'],
            'task_create' => $task_create->format('Y-m-d H:i:s'),
            'task_term' => $task_term->format('Y-m-d H:i:s')]);

    }


    public function scopeShowTask($query, $id)
    {
        return $query->where('Task_id',$id)->get()->toArray();
    }

    public function scopePutAnswer($query)
    {
        $task_end =new \DateTime('', new \DateTimeZone('europe/kiev'));
        $query->where('task_id', session('task_id'))->update(['task_result'=>$_POST['text'],'status_id'=>'2','task_end'=>$task_end]);
    }


}