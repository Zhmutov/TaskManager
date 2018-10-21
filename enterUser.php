<?php
/** Добавить пользователя в TaskManager*/
?>

<form action="<?php echo $pageUri ?> class=form-inline"  method="post">
<center>
    <div class="form-group mb-2">
        <label for="staticEmail2">Login</label>

        <input type="text" name="login"  value="Login">

    </div>
    </br>
    <div class="form-group mx-sm-3 mb-2">
        <label for="inputPassword2">Password</label>

        <input type="password" name="password"  placeholder="Password" value="Password">
    </div>
    </br>
    <button type="submit" class="btn btn-primary mb-2">Submit</button>
</center>
</form>
