

<form  class=form-inline"  method="get">
    <center>
        <div class="form-group mb-2">
            <label for="staticEmail2">Name</label>
            <input type="text" name="name"   value=" {{$userName}}">
        </div>
        </br>
        <div class="form-group mb-2">
            <label for="staticEmail2">Surname</label>
            <input type="text" name="surname"  value="{{$Surname}}">
        </div>
        </br>
        <div class="form-group mb-2">
            <label for="staticEmail2">Patronymic</label>
            <input type="text" name="patronymic" value="Patronymic">
        </div>
        </br>
        <div class="form-group mb-2">
            <label for="staticEmail2">Country</label>
            <input type="text" name="country" value="Country">
        </div>
        </br>
        <div class="form-group mb-2">
            <label for="staticEmail2">City</label>
            <input type="text" name="city"  value="City">
        </div>
        </br>
        <div class="form-group mx-sm-3 mb-2">
            <label for="inputPassword2">Birth Date</label>

            <input type="date" name="birthDate" placeholder="Birth Date">
        </div>
        </br>
        <button type="registration" >Registration</button>
    </center>
</form>