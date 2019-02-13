@if((session('user_id')==$creater_user_id) || (session('user_id')==$worker_user_id))
    <form id="postForm" method="POST" action="{{route('putanswer')}}">
        {{ csrf_field() }}
        <p align='right'><a href='{{session('listaction')}}'>Назад</a></p>
        <table border="1">
            <tr style="background-color:#228B22">
                <td>Инициатор</td>
                <td>Исполнитель</td>
                <td>Срок</td>
                <td>статус</td>
            </tr>
            <tr>
                <td>{{$creater_FIO}}</td>
                <td>{{$worker_FIO}}</td>
                <td>{{$task_term}}</td>
                <td>@if($status_id=='1') В работе @else Выполнено @endif</td>
            </tr>
        </table>
        <br/>


        <label>Тема:</label><br>
        <p>{{$task_subject}} </p><br>
        <label>Текст задачи:</label><br>
        <table border="0">
            <tr>
                <td>
                    @php
                        echo "$task_body". PHP_EOL;
                    @endphp
                </td>
                <td width=230></td>
            </tr>
        </table>
        <br>
        <br>
        <br>

        {{--<textarea type="text" name="text" id="text">{{$task_body}}</textarea>--}}
        @if((session('user_id')==$worker_user_id)&&($status_id=='1'))
            <label for="text">Ответ:</label><br/>
            <textarea type="text" name="text" id="text"></textarea>
            <button type="submit">Ответить</button>
        @else
            <label>Ответ:</label><br>
            <table border="0">
                <tr>
                    <td>
                        @php
                            echo "$task_result". PHP_EOL;
                        @endphp
                    </td>
                    <td width=230></td>
                </tr>
            </table>


        @endif
    </form>
@endif




