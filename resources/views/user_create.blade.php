<form method="POST" action="/user">
    {{ csrf_field() }}
    <input type="text" name="username">
    </br>
    </br>

    <input type="text" name="salary">
    </br>
    </br>
    <input type="text" name="salary2">
    </br>
    </br>

    <input type="submit">
</form>