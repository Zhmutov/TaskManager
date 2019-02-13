@if (session()->get('user_id','')=='')
    <center>
        <table>
            <tr>
                <td>


                    <form method="POST" action="/authorization">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend align="center" title="введите логин и пароль">Авторизация</legend>
                            <pre>
Логин:  <input type="text" name="login" value={{session()->get('login', '') }}>

Пароль: <input type="password" name="password">

         <input type="submit">
</pre>
                        </fieldset>
                    </form>
                </td>
            </tr>
        </table>

    </center>

@endif