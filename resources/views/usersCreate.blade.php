@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->get('user_id')<>'')
    <?php $fio = session()->get('inform_id')?:'';?>
    <center>
        <table>
            <tr>
                <td>

        <form method="POST" @IF (isset($user['inform_id'])) action="{{ route('usersCreate')}}" @ENDIF>
           {{ csrf_field() }}
            <fieldset>
                $user['user_photo']
                <legend align="center" title = 'введите данные по пользователю'>Данные пользователя</legend>
<pre>
<b>Логин:         </b><input size="30" type="text" name="login" @IF (isset($user['login'])) value = "{{$user['login']}}" @else value="{{old('login')}}" @endif>

<b>Пароль:        </b><input size="30"  type="password" name="password" @IF (isset($user['password'])) value = "{{$user['password']}}" @endif>

<b>Доступ:        </b><select  name="role">
                <option value="1" @IF (isset($user['role_id'])) @if ($user['role_id'] == 1)  selected @endif @endif >Администратор</option>
                <option value="2" @IF (isset($user['role_id'])) @if ($user['role_id'] == 2)  selected @endif @endif >Руководитель</option>
                <option value="3" @IF (isset($user['role_id'])) @if ($user['role_id'] == 3)  selected @endif @endif >Менеджер</option>
                <option value="4" @IF (isset($user['role_id'])) @if ($user['role_id'] == 4)  selected @endif @endif >Работник</option>
            </select>

<b>ФИО:           </b><input size="30" type="text" name="FIO" size="25" @IF (isset($oneUserInfCheck['FIO'])) value = "{{$oneUserInfCheck['FIO']}} " @else value="{{old('FIO')}}" @endif >

<b>Страна:        </b><input size="30" type="text" name="country" @IF (isset($oneUserInfCheck['country'])) value = "{{$oneUserInfCheck['country']}}" @else value="{{old('country')}}" @endif>

<b>Город:         </b><input size="30" type="text" name="city" @IF (isset($oneUserInfCheck['city'])) value = "{{$oneUserInfCheck['city']}}" @else value="{{old('city')}}" @endif>

<b>День рождения: </b><input type="date" name="birthDate" @IF (isset($oneUserInfCheck['birth_date'])) value = "{{$oneUserInfCheck['birth_date']}}" @else value="{{old('birth_date')}}"@endif>

<b>Фото:          </b><input type="file" name="image">

                 <input type="submit" @IF (!isset($oneUserInfCheck['inform_id'])) value="СОЗДАТЬ" @else  value="ИЗМЕНИТЬ "@ENDIF>
</pre>
                    </fieldset>
                    </form>

                </td>
            </tr>
        </table>
    </center>

@endif