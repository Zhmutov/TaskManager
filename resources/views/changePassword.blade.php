{{--@if (count($errors) > 0)--}}
{{--<div class="alert alert-danger">--}}
{{--<ul>--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}

@if (session()->get('user_id')<>'')
    <center>
        <table>
            <tr>
                <td>
                    <form method="POST" action="/changePassword">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend align="center" title="введите новый логин и пароль">Смена пароля</legend>
                            <pre>
Логин:                 <input type="text" name="login" value={{session()->get('login', '') }}>

Старый пароль:         <input type="password" name="oldPassword" value={{session()->get('password', '') }}>

Новый пароль:          <input type="password" name="password">

Повторный ввод пароль: <input type="password" name="confirmed_password">

               <input type="submit" value="ИЗМЕНИТЬ">
</pre>
                        </fieldset>

                    </form>
                </td>
            </tr>
        </table>
    </center>
@endif