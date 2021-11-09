<?php

class Category {
    private string $id;
    private string $title;

    public function __construct(string $id, string $category) {
        $this->id = $id;
        $this->title = $category;
    }

    public function __toString() {
        return $this->id . " " . $this->title;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getCategory(): string {
        return $this->title;
    }

    public function setCategory(string $category): void {
        $this->title = $category;
    }
}

class BizCatComposite {
    private string $id;
    private string $name;
    private string $address;
    private string $city;
    private string $telephone;
    private string $url;
    private string $category_ID;

    public function __construct(string $id, string $name, string $address, string $city, string $telephone, string $url, string $category_ID) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->telephone = $telephone;
        $this->url = $url;
        $this->category_ID = $category_ID;
    }

    public function getCategoryID(): string {
        return $this->category_ID;
    }

    public function setCategoryID(string $category_ID): void {
        $this->category_ID = $category_ID;
    }

    public function getId(): string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function setAddress(string $address): void {
        $this->address = $address;
    }

    public function getCity(): string {
        return $this->city;
    }

    public function setCity(string $city): void {
        $this->city = $city;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function setUrl(string $url): void {
        $this->url = $url;
    }
}

?>

<?php
$server_username = 'b387322b6006bc';
$server_password = '0739b344';
$server_host = "us-cdbr-east-03.cleardb.com";
$database = 'heroku_eedca10c2fc1c8a';

$conn = mysqli_connect($server_host, $server_username, $server_password, $database) or die("cant connect to database");

$categories = array();
$bizcats = array();
$sql = "SELECT * FROM Category";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = new Category($row["category_ID"], $row["title"]);
    }
} else {
    echo "0 results";
}

function getData($conn, $categoryTitles) {
    if (count($categoryTitles) > 1) {
        $sql = "SELECT *
                        FROM business b, biz_category bc, category c
                        WHERE b.business_ID = bc.business_ID AND c.category_ID = bc. category_ID
                        AND c.title IN (" . "'" . implode("', '", $categoryTitles) . "'" . ")
                 ";
    } else {
        $title = $categoryTitles[0];
        $sql = "SELECT *
                        FROM business b, biz_category bc, category c
                        WHERE b.business_ID = bc.business_ID AND c.category_ID = bc. category_ID
                        AND c.title = " . "'" . $title . "'";
    }

    $result = $conn->query($sql);

    $bizcats = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bizcats[] = new BizCatComposite(
                $row["business_ID"],
                $row["name"],
                $row["address"],
                $row["city"],
                $row["telephone"],
                $row["URL"],
                $row["category_ID"]
            );
        }
    } else {
        echo "0 results";
    }
    return $bizcats;
}

function displayData($bizcats) {
    echo "<table>";
    foreach ($bizcats as $b) {
        echo "<tr><td>" . $b->getId() . "</td>
            <td>" . $b->getName() . "</td>
            <td>" . $b->getAddress() . " </td>
            <td>" . $b->getCity() . " </td>
            <td>" . $b->getTelephone() . " </td>
            <td>" . $b->getUrl() . " </td>
            <td>" . $b->getCategoryID() . " </td></tr>";
    }
    echo "</table>";
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Business Listing</title>
    <style>
        form, table {
            float: left;
        }

        table, th, td {
            border: 1px solid black;
        }

        a {
            text-decoration: none;
        }

        table {
            border: 1px solid black;
        }

        table th {
            padding: 10px;
            background: #eee;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }

        table td {
            padding: 10px;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }
        body {
            width:auto;
            margin:0 auto;
            padding: 20px 20px;
        }
    </style>
</head>
<body>
<h1>Business Listings</h1>
<table>
    <tr>
        <th>Click a category to find business listings:</th>
    </tr>
    <?php
    foreach ($categories as $c) {
        echo "<tr><td><a href='?categorySelect={$c->getCategory()}'>{$c->getCategory()}</a></td></tr>";
    }
    ?>
</table>

<?php
if (isset($_GET["categorySelect"])) {
    $categoryTitles = array();
    array_push($categoryTitles, $_GET["categorySelect"]);
    $bizcats = getData($conn, $categoryTitles);
    displayData($bizcats);
}
?>
</body>
</html>