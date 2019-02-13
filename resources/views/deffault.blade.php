

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.css" rel="stylesheet">
    <style>
        A {
            color: #000000; /* Цвет ссылок */
        }
        A:active {
            color: #ff0d1e; /* Цвет активных ссылок */
        }
        /*table {*/
            /*width: 100%; !* Ширина таблицы *!*/
        /*}*/
        td {
            padding: 10px;
            /*vertical-align: top; !* Выравнивание по верхнему краю ячеек *!*/
        }
        .col1 { background: #ccc; }
        .col2 { background: #ffd; }
    </style>

</head>
<body>
<table Border=0   width="100%" height="100%">
    <tr >
        <td bgcolor="#A9A9F5" width="20%" height= "150" ><img width="100%" height="100%" src="/img/1234.jpg"></td>
        <td bgcolor =  "#A9A9F5" valign="top">  @include ('header') </td>
    <tr>
        <td  bgcolor =  "#A9A9F5" valign="top" >@include('leftmenu')</td>
        <td bgcolor="#FBEFEF" valign ='top'><center>{{session()->get('message','')}}</center>@if(isset($inf))  @include($inf,$nextinf)@else <legend align="center"> Информация о структуре БД проекта</legend><img width="100%" height="100%" src="/img/BD.jpg"> @endif </td>
    </tr>
</table>


<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

<!-- подключаем сам summernote -->

<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.7/summernote.js"></script>


<script>

    $(document).ready(function() {

       $('#text').summernote({
           lang:'ru-RU',
           height:200,
           width:830,
           right: 10,
           minHeight:200,
           padding: 20,
           //maxHeight:200,
           focus:true,
           placeholder:'Введите данные',
           fontNames:['Arial','Times New Roman','Helvetica']
       });



    });



    var postForm = function() {
        var text = $('textarea[name="text"]').html($('#text').code());}

</script>


</body>
</html>
<?php session(['message' => '']);