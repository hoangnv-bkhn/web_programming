<?php
include './model/BizCatComposite.php';
include './model/Category.php';

$server_username = 'b387322b6006bc';
$server_password = '0739b344';
$server_host = "us-cdbr-east-03.cleardb.com";
$database = 'heroku_eedca10c2fc1c8a';

$conn = mysqli_connect($server_host, $server_username, $server_password, $database) or die("cant connect to database");

if (isset($_GET['inputText'])) {
    $input = $_GET['inputText'];
    $categories = array();
    $sql = "SELECT * FROM Category WHERE title LIKE '%" . $input . "%'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = array('title' => $row["title"]);
        }
        echo json_encode($categories);
    }
}