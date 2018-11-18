<?php


if ($_POST) {
    echo '<pre>';
    echo htmlspecialchars(print_r($_POST,true));
    echo '</pre>';
}

?>
<form method="post" xmlns="http://www.w3.org/1999/html">
    Name: <input type="text" name="personal[name]"/>
    Email: <input type="text" name="personal[email]"/>
    <select multiple name="select_box=array()">
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="C">C</option>
</select>
    <input type="submit" value="sub"/>
</form>
