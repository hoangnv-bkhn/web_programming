<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Time Processing</title>
</head>

<body>
<h2>Enter your name and select date and time for appointment</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <table>
        <tr>
            <td>Your name:</td>
            <td colspan="3"><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td><select name="day">
                    <?php
                    for ($i = 1; $i < 32; $i++) {
                        print("<option>$i</option>");
                    }
                    ?>
                </select>
            </td>
            <td><select name="month">
                    <?php
                    for ($i = 1; $i < 13; $i++) {
                        print("<option>$i</option>");
                    }
                    ?>
                </select>
            </td>
            <td><select name="year">
                    <?php
                    for ($i = 1900; $i < 2021; $i++) {
                        print("<option>$i</option>");
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Time:</td>
            <td><select name="hour">
                    <?php
                    for ($i = 0; $i < 24; $i++) {
                        print("<option>$i</option>");
                    }
                    ?>
                </select>
            </td>
            <td><select name="min">
                    <?php
                    for ($i = 0; $i < 60; $i++) {
                        print("<option>$i</option>");
                    }
                    ?>
                </select>
            </td>
            <td><select name="sec">
                    <?php
                    for ($i = 0; $i < 60; $i++) {
                        print("<option>$i</option>");
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Submit"></td>
            <td><input type="reset" value="Reset"></td>
        </tr>
    </table>
</form>
<?php
if (array_key_exists("name", $_POST)) {
    $check = 1;
    $temp = "AM";
    $name = $_POST["name"];
    $day = $_POST["day"];
    $month = $_POST["month"];
    $year = $_POST["year"];
    $sec = $_POST["sec"];
    $min = $_POST["min"];
    $hour = $_POST["hour"];
    if ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
        if ($day > 30) $check = 0;
    } else if ($month == 2) {
        if ($month % 4 == 0) {
            if ($month % 100 == 0) {
                if ($month % 400 == 0) {
                    if ($day > 29) $check = 0;
                } else {
                    if ($day > 28) $check = 0;
                }
            }
        } else if ($day > 28) $check = 0;
    } else {
        if ($day > 30) $check = 0;
    }
    if ($check == 0) print("Error: Date");
    print("Hi $name!<br>You have choose to have an appointment on $hour:$min:$sec, $day/$month/$year<br><br>More information<br><br>");
    if ($hour >= 12) {
        $hour -= 12;
        $temp = "PM";
    }
    print("<br>In 12 hours the time and date is $hour:$min:$sec $temp,$day/$month/$year ");
    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            print("<br>This month has 31 days!");
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            print("<br>This month has 30 days!");
            break;
        case 2:
            if ($check == 0) {
                print("<br>This month has 28 days!");
            } else {
                print("<br>This month has 29 days!");
            }
            break;
        default:
            break;
    }
}
?>
</body>

</html>