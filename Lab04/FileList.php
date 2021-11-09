<?php

if (isset($_POST["sort_key"])) {
    $submitted = $_POST["submitted"];
    $sort_key = $_POST["sort_key"];
} else {
    $sort_key = "name";
    $submitted = false;
}

$dir = 'upload/';
$files = array();
foreach (array_diff(scandir($dir), array('.', '..')) as $file){
    array_push($files, array(
        "name" => $file,
        "type" => pathinfo($dir.$file, PATHINFO_EXTENSION) == ""? "file" : pathinfo($dir.$file, PATHINFO_EXTENSION),
        "date" => filemtime($dir.$file),
        "size" => filesize($dir.$file)
    ));
};
?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <p style="width:800px; margin:0 auto; padding: 20px 20px">
        <input type="radio" name="sort_key" value="name" id="name" <?php if ($sort_key == 'name') echo "checked='checked'"; ?> /><label for="name"> Sort by Name</label> <br />
        <input type="radio" name="sort_key" value="date" id="date" <?php if ($sort_key == 'date') echo "checked='checked'"; ?> /><label for="date"> Sort by Date</label> <br />
    </p>

    <p style="width:800px; margin:0 auto; padding: 20px 20px">
        <input type="submit" value="Sort" name="submitted" />
    </p>

    <p style="width:800px; margin:0 auto; padding: 20px 20px">
        Values <?= "sorted by $sort_key"?>:
    </p>

    <table style="width:800px; margin:0 auto; padding: 20px 20px">
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Date</th>
            <th>Size</th>
        </tr>
        <?php


        if ($submitted) {
            if ($sort_key == 'date') {
                uasort($files, function ($a, $b) {
                    return $a['date'] > $b['date'] ? 1 : ($a['date'] == $b['date'] ? 0 : -1);
                });
            } else {
                uasort($files, function ($a, $b) {
                    return $a['name'] > $b['name'] ? 1 : ($a['name'] == $b['name'] ? 0 : -1);
                });
            }
        }
        foreach ($files as $file) {
            echo "<tr>";
            foreach ($file as $key => $filei) {
                if ($key == 'date') {
                    echo "<td>".date("d-m-Y", $filei)."</td>";
                } else {
                    echo "<td>".$filei."</td>";
                }
            };
            echo "</tr>";
        }
        ?>
    </table>
</form>