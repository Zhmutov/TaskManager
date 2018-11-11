@if (session()->get('user_id')<>'')
    <?php $fio = session()->get('inform_id')?:'';?>
    <center><form method="POST" action="{{ route('usersCreate') }}">
            {{ csrf_field() }}
            Логин: <input type="text" name="login" >
            </br>
            </br>

            Пароль: <input type="text" name="password" >
            </br>
            </br>

            Доступ: <select name="role">
                <option value="1" >Администратор</option>
                <option value="2" >Руководитель</option>
                <option value="3" >Менеджер</option>
                <option value="4" >Работник</option>
            </select>
            </br>
            </br>

            ФИО: <input type="text" name="FIO" value="<?= $fio?>">
            </br>
            </br>

            Страна: <input type="text" name="country">
            </br>
            </br>

            Город: <input type="text" name="city">
            </br>
            </br>

            День роздение: <input type="date" name="birthDate">
            </br>
            </br>


            <input type="submit" value="СОЗДАТЬ">
        </form></center>
@endif