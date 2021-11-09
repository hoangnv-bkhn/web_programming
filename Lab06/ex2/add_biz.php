<!DOCTYPE html>
<html>
<head>
    <title>
        Business Registration
    </title>
    <style>
        h1 {text-align: center;}
        #add_business {
            display: block;
            margin-right: auto;
            margin-left: auto;
            margin-top: 20px;
        }
        #tab1 {
            width:800px;
            margin:0 auto;
            padding: 20px 20px;
        }
        select {
            width:400px;
        }
    </style>
</head>
<body>
<?php
$server_username = 'b387322b6006bc';
$server_password = '0739b344';
$server_host = "us-cdbr-east-03.cleardb.com";
$database = 'heroku_eedca10c2fc1c8a';

$conn = mysqli_connect($server_host, $server_username, $server_password, $database) or die("cant connect to database");

if (isset($_POST['categories']) && isset($_POST['businessName']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['tel']) && isset($_POST['url'])) {
    $businessName = $_POST['businessName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $telephone = $_POST['tel'];
    $url = $_POST['url'];
    $categories = $_POST['categories'];

    if ($businessName == '' || $address == '' || $city == '' || $telephone == '' || $url == '' || count($categories) === 0)
        die('Missing some fields!');

    mysqli_query($conn, "INSERT INTO business(name, address, city, telephone, url) VALUES('$businessName','$address', '$city', '$telephone', '$url')");

    $business_id = mysqli_fetch_all(mysqli_query($conn, "SELECT business_id FROM business WHERE name = '$businessName'"))[0][0];
    foreach ($categories as $category) {
        $category_id = mysqli_fetch_all(mysqli_query($conn, "SELECT category_id FROM category WHERE title = '$category'"))[0][0];
        $query = sprintf("INSERT INTO biz_category VALUES('$business_id', '$category_id')");
        mysqli_query($conn, $query);
    }

}

$query = "SELECT * FROM category";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) <= 0) die('No data is fetched!');
?>

<h1>Business Registration</h1>

<form action="add_biz.php" method="post">
    <div style="display: flex; flex-direction: row-reverse;justify-content: space-between; padding: 0 50px;">

        <table>
            <tr>
                <td>Business Name:</td>
                <td><input type="text" name="businessName" size="50"></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" size="50"></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><input type="text" name="city" size="50"></td>
            </tr>
            <tr>
                <td>Telephone:</td>
                <td><input type="text" name="tel" size="50"></td>
            </tr>
            <tr>

                <td>URL:</td>
                <td><input type="text" name="url" size="50"></td>
            </tr>


        </table>


        <div id="tab1">
            <p>Click on one, or control-click on multiple categories:</p>
            <select name="categories[]" multiple="multiple" size="10">
                <?php
                while ($row = mysqli_fetch_array($result))
                    echo '<option>' . $row['title'] . '</option>';
                ?>
            </select>
        </div>
    </div>

    <input type="submit" name="submit" value="Add Business" id="add_business"><br>
</form>

</body>
</html>