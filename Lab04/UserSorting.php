<?php

if (isset($_POST["sort_type"])) {
    $submitted = $_POST["submitted"];
    $sort_type = $_POST["sort_type"];
} else {
    $sort_type = "unsorted";
    $submitted = false;
}

function user_sort($a, $b)
{
    // smarts is all-important, so sort it first
    if ($b == 'smarts') {
        return 1;
    } else if ($a == 'smarts') {
        return -1;
    }

    return ($a == $b) ? 0 : (($a < $b) ? -1 : 1);
}
$values = array(
    'name' => 'Buzz Lightyear',
    'email_address' => 'buzz@starcommand.gal',
    'age' => 32,
    'smarts' => 'some'
);
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <p style="width:800px; margin:0 auto; padding: 20px 20px">
        <input type="radio" name="sort_type" value="sort" id="sort" <?php if ($sort_type == 'sort') echo "checked='checked'"; ?> /> <label for="sort"> Standard sort</label><br />
        <input type="radio" name="sort_type" value="rsort" id="rsort" <?php if ($sort_type == 'rsort') echo "checked='checked'"; ?> /> <label for="rsort"> Reverse sort</label><br />
        <input type="radio" name="sort_type" value="usort" id="usort" <?php if ($sort_type == 'usort') echo "checked='checked'"; ?> /> <label for="usort"> User-defined sort</label><br />
        <input type="radio" name="sort_type" value="ksort" id="ksort" <?php if ($sort_type == 'ksort') echo "checked='checked'"; ?> /> <label for="ksort"> Key sort</label><br />
        <input type="radio" name="sort_type" value="krsort" id="krsort" <?php if ($sort_type == 'krsort') echo "checked='checked'"; ?> /> <label for="krsort"> Reverse key sort</label><br />
        <input type="radio" name="sort_type" value="uksort" id="uksort" <?php if ($sort_type == 'uksort') echo "checked='checked'"; ?> /> <label for="uksort"> User-defined key sort</label><br />
        <input type="radio" name="sort_type" value="asort" id="asort" <?php if ($sort_type == 'asort') echo "checked='checked'"; ?> /> <label for="asort"> Value sort</label><br />
        <input type="radio" name="sort_type" value="arsort" id="arsort" <?php if ($sort_type == 'arsort') echo "checked='checked'"; ?> /> <label for="arsort"> Reverse value sort</label><br />
        <input type="radio" name="sort_type" value="uasort" id="uasort" <?php if ($sort_type == 'uasort') echo "checked='checked'"; ?> /> <label for="uasort"> User-defined value sort</label><br />
    </p>

    <p style="width:800px; margin:0 auto; padding: 20px 20px">
        <input type="submit" value="Sort" name="submitted" />
    </p>

    <p style="width:800px; margin:0 auto; padding: 20px 20px">
        Values <?= $submitted ? "sorted by $sort_type" : "unsorted"; ?>:
    </p>

    <ul style="width:800px; margin:0 auto;">
        <?php


        if ($submitted) {
            if ($sort_type == 'usort' || $sort_type == 'uksort' || $sort_type == 'uasort') {
                $sort_type($values, 'user_sort');
            } else {
                $sort_type($values);
            }
        }
        foreach ($values as $key => $value) {
            echo "<li><b>$key</b>: $value</li>";
        }
        ?>
    </ul>
</form>