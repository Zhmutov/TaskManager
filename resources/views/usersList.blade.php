@if (session()->get('role_id',0)==1)
    <center>
        <form method="POST" action="{{ route('usersList') }}">
            {{ csrf_field() }}
            <table border="1" align="left" width="100%" >
                <tr style="background-color:#228B22">
                    <td width="5%" ><b>ИД</b></td>
                    <td width="50%" ><b>ФИО</b></td>
                    <td width="25%" ><b>Дата создания</b></td>
                    <td width="20%" ><b>Роль</b></td>
                </tr>
                <tr>
                    <?php
                    foreach ($allUser as $user) {
                        echo '<tr>'.
                                '<td>'.$user['inform_id'].'</td>'.
                                '<td style="background-color:#ffffcc">'.'<a href=' . 'create/' . $user['inform_id'] . '>' . $user['FIO'] . '</a>'.'</td>'.
                                '<td>'.$user['create_date'].'</td>'.
                                '<td>'.$user['role_name'].'</td>'.
                            '</tr>';
                    }
                    ?>
                </tr>
            </table><br>


         {{ $allUser->links() }}

        </form>
    </center>
@endif