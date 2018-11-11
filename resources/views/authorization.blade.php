@if (session()->get('user_id')=='')
<center><form method="POST" action="/authorization">
    {{ csrf_field() }}
   Логин: <input type="text" name="login" value={{session()->get('login', '') }}>
    </br>
    </br>

   Пароль: <input type="text" name="password">
    </br>
    </br>


    <input type="submit">
</form></center>
@endif