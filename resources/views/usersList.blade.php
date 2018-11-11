@if (session()->get('users')<>'')
    <center>
        <form method="POST" action="{{ route('usersCreate') }}">
            {{ csrf_field() }}
            <?php

            foreach (session()->get('users') as $user) {

               // echo " <a href=" . $user['FIO'] . '?page=' . $user['FIO'] . '>' . $user['FIO'] . '</a> </br>';
                echo " <a href=" . 'create/' . $user['inform_id']. '>' . $user['FIO'] . '</a> </br>';
              //  session(['inform_id' => $user['inform_id']]);
            }

            ?>
        </form>
    </center>
@endif