@if (session()->get('user_id')<>'')
    <center><form method="POST" action="/changePassword">
            {{ csrf_field() }}
            Логин: <input type="text" name="login" value={{session()->get('login', '') }}>
            </br>
            </br>

            Старый пароль: <input type="password" name="oldPassword" value={{session()->get('password', '') }}>
            </br>
            </br>

            Новый пароль: <input type="password" name="newPassword">
            </br>
            </br>

            Повторить новый пароль: <input type="password" name="password">
            </br>
            </br>


            <input type="submit" value="ИЗМЕНИТЬ">
        </form></center>
@endif