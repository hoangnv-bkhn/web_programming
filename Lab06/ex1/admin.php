<html>
<head>
    <title>Category Administrator</title>
    <style>
        h1 {text-align: center;}
        #add_category {
            display: block;
            margin-right: auto;
            margin-left: auto;
            margin-top: 20px;
        }
    </style>
</head>
<h1>Category Administrator</h1>
<body style="width:800px; margin:0 auto; padding: 20px 20px">
<form action='admin.php' method='POST'>
    <table>
        <tr style="text-align:center; font-weight: bold; background-color: coral;">
            <td style='width: 200px'>Category ID</td>
            <td style='width: 350px'>Title</td>
            <td style='width: 350px'>Description</td>
        </tr>
        <?php
        $server_username = 'b387322b6006bc';
        $server_password = '0739b344';
        $server_host = "us-cdbr-east-03.cleardb.com";
        $database = 'heroku_eedca10c2fc1c8a';

        $conn = mysqli_connect($server_host, $server_username, $server_password, $database) or die("cant connect to database");

        $select_all = "select * from category";
        if ($result = $conn->query($select_all)) {
            while ($row = $result->fetch_assoc()) {
                $catID = $row["category_ID"];
                $title = $row["title"];
                $desc = $row["description"];

                echo '<tr><td>' . $catID . '</td>';
                echo '<td>' . $title . '</td>';
                echo '<td>' . $desc . '</td></tr>';
            }
        } else {
            echo 'query failed<br>';
        }
        ?>
        <tr>
            <td><input style='width:100%' type='text' name='cateID'></td>
            <td><input style='width:100%' type='text' name='title'></td>
            <td><input style='width:100%' type='text' name='desc'></td>
        </tr>
    </table>
    <input type='Submit' value="Add Category" name='submitted' id="add_category">
    <?php
    if (isset($_POST['submitted'])) {
        if (isset($_POST['cateID']) && isset($_POST['title']) && isset($_POST['desc'])
            && $_POST['cateID'] != '' && $_POST['title'] != '' && $_POST['desc'] != '') {
            $cateID = $_POST['cateID'];
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $insert_cmd = 'insert into category values (\'' . $cateID . '\',\'' . $title . '\',\'' . $desc . '\')';
            if ($conn->query($insert_cmd)) {
                header("Refresh:0");
                echo "<br>success";
            } else {
                echo "<br>Fail! Please enter all fileds";
            }
        }
    }
    ?>
</form>
</body>
</html>