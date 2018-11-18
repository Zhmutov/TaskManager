@if (session()->get('user_id')<>'')
    <?php $fio = session()->get('inform_id')?:'';?>
    <center><form method="POST" @IF (isset($user['inform_id'])) action="{{ route('usersCreate')}}" @ENDIF>
            {{--<form method="POST" @IF (isset($user['inform_id'])) action="{{ route('usersCreate')}}" @ELSE  action="{{ route('updateOneUsersInf')}}" @ENDIF >--}}
            {{ csrf_field() }}
            Логин: <input type="text" name="login" @IF (isset($user['login'])) value = {{$user['login']}}@endif>
            </br>
            </br>

            Пароль: <input type="password" name="password" @IF (isset($user['password'])) value = {{$user['password']}}@endif>
            </br>
            </br>

            Доступ: <select name="role">
                <option value="1" @IF (isset($user['role_id'])) @if ($user['role_id'] == 1)  selected @endif @endif >Администратор</option>
                <option value="2" @IF (isset($user['role_id'])) @if ($user['role_id'] == 2)  selected @endif @endif >Руководитель</option>
                <option value="3" @IF (isset($user['role_id'])) @if ($user['role_id'] == 3)  selected @endif @endif >Менеджер</option>
                <option value="4" @IF (isset($user['role_id'])) @if ($user['role_id'] == 4)  selected @endif @endif >Работник</option>
            </select>
            </br>
            </br>
            ФИО: <input type="text" name="FIO" size="25" @IF (isset($oneUserInfCheck['FIO'])) value = "{{$oneUserInfCheck['FIO']}}"@endif >
            </br>
            {{--ФИО: <textarea  type="text" name="FIO" >@IF (isset($oneUserInfCheck['FIO'])) {{$oneUserInfCheck['FIO']}}@endif </textarea>--}}
             </br>
            Страна: <input type="text" name="country" @IF (isset($oneUserInfCheck['country'])) value = {{$oneUserInfCheck['country']}}@endif>
            </br>
            </br>

            Город: <input type="text" name="city" @IF (isset($oneUserInfCheck['city'])) value = {{$oneUserInfCheck['city']}}@endif>
            </br>
            </br>

            День рождения: <input type="date" name="birthDate" @IF (isset($oneUserInfCheck['birth_date'])) value = {{$oneUserInfCheck['birth_date']}}@endif>
            </br>
            </br>

            <input type="submit" @IF (!isset($oneUserInfCheck['inform_id'])) value="СОЗДАТЬ"@ENDIF  value="ИЗМЕНИТЬ ">
        </form></center>
@endif