<?php
//var_dump($tasks->subject);
//?>
<table border="1">
    <div class="container">
        <tr style="background-color:#228B22">
            <td><b>ИД</b></td>
            <td><b>Тема</b></td>
            <td><b>Исполнитель</b></td>

            <td><b>Дата создания</b></td>
            <td><b>Срок</b></td>
            <td><b>Дата выполнения</b></td>
            <td><b>Статус</b></td>
        </tr>
        @foreach ($tasks as $task)
            <?php
            date_default_timezone_set('europe/kiev');
            $color = '';
            $timenow = date('y-m-d H:i:s.u');
            $datediff = date_diff(new DateTime($timenow), new DateTime($task->task_term))->days;
            if (isset($task->task_end)) {
                $color = '#ADFF2F';
            }
            elseif (strtotime($timenow) > strtotime($task->task_term)){
                $color = '#FF0000';
            }
            elseif ($datediff == 0) {
                $color = '#DC143C';
            }

            //  echo date_diff(new DateTime($timenow),new DateTime($task->task_term))->days;

            ?>
            <tr BGCOLOR="#F2F5A9" >
                <td>{{ $task->task_id }} </td>
                <td><b><p align ='right'><a href='/task/{{ $task->task_id }}'>{{ $task->task_subject }}</a></p></b> </td>
                <td>{{ $task->worker }} </td>
                <td>{{ $task->task_create }} </td>
                <td bgcolor={{$color}}>{{ $task->task_term }} </td>
                <td>{{ $task->task_end}} </td>
                <td>{{ $task->status_name }} </td>

            </tr>
        @endforeach
    </div>
</table>
{{ $tasks->links() }}

