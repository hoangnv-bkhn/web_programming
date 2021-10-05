<html>
<head><title>Radians To Degrees Converter</title></head>
<body>
<p>Enter your value to be converted</p>
<form action="" method="post">
    <input type="text" size="10" maxlength="5" name="value">
    <br><br>
    <input type="radio" name="degree" value="degree">Degree
    <input type="radio" name="radian" value="radian">Radian
    <br><br>
    <input type="submit" value="Submit">
</form>
<?php
if (isset($_POST["degree"])) {
    echo $_POST["value"] . " (degree)" . " = ";
    echo (pi() / 180 * $_POST["value"]) . " (radian)";
}

if (isset($_POST["radian"])) {
    echo $_POST["value"] . " (radian)" . " = ";
    echo (180 / pi() * $_POST["value"]) . " (degree)";
}
?>
</body>
</html>