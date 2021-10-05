<!DOCTYPE html>
<html>
<head><title>Date Time Function</title></head>
<body>
<h1>Enter data:</h1>
<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <table>
        <tr>
            <td>Name1:</td>
            <td><input type="text" name="name1"></td>
        </tr>
        <tr>
            <td>Birthday1:</td>
            <td><input type="date" name="date1"></td>
        </tr>
        <tr>
            <td>Name2:</td>
            <td><input type="text" name="name2"></td>
        </tr>
        <tr>
            <td>Birthday2:</td>
            <td><input type="date" name="date2"></td>
        </tr>
        <tr>
            <td><input type="submit" value="SUBMIT"></td>
            <td><input type="submit" value="RESET"></td>
        </tr>
    </table>
    <?php
    if (array_key_exists("name1", $_POST) && array_key_exists("name2", $_POST) ) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name1 = $_POST["name1"];
            $date1 = $_POST["date1"];
            $name2 = $_POST["name2"];
            $date2 = $_POST["date2"];
        }
        $date1 = strtotime($date1);
        $date1 = getdate($date1);
        $date2 = strtotime($date2);
        $date2 = getdate($date2);
        echo "$name1 :  ";
        echo "$date1[weekday], $date1[month] $date1[mday], $date1[year]";
        echo "<br>";
        echo "$name2 :  ";
        echo "$date2[weekday], $date2[month] $date2[mday], $date2[year]";
        echo "<br>";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name1 = $_POST["name1"];
            $date1 = $_POST["date1"];
            $name2 = $_POST["name2"];
            $date2 = $_POST["date2"];
        }
        $date1 = date_create($date1);
        $date2 = date_create($date2);
        print  "The difference in days between two dates: ";
        $diff = date_diff($date1, $date2);
        echo $diff->format("%R%a days");
        echo "<br>";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name1 = $_POST["name1"];
            $date1 = $_POST["date1"];
            $name2 = $_POST["name2"];
            $date2 = $_POST["date2"];
        }
        echo "$name1 :  ";
        echo date("Y") - date("Y", strtotime($date1)) . "(year old)";
        echo "<br>";
        echo "$name2 :  ";
        echo date("Y") - date("Y", strtotime($date2)) . "(year old)";
        echo "<br>";
        echo "difference years between two persons: ";
        echo "<br>";
        echo $name1 . "'s age" . "  -  " . $name2 . "'s age" . "=";
        echo date("Y", strtotime($date2)) - date("Y", strtotime($date1));
    }

    ?>
</body>
</html>