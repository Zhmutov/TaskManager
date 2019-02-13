

@if (session()->get('user_id')=='')
<form method="GET" action="/authorization">
    <p align="right"><input type="submit" value="       вход       ">   </p></form>
{{--<form method="GET" action="/registration">--}}
    {{--<p align="right"><input type="submit" value="регистрация ">   </p>--}}
{{--</form>--}}
@else

    <form method="GET" action="/exit">

        <p align="right">{{session()->get('FIO')}}  </p>
        <p align="right"><input type="submit" value="       выход       ">   </p>
    </form>
@endif


