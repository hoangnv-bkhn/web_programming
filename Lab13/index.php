<?php
include './model/BizCatComposite.php';
include './model/Category.php';

$server_username = 'b387322b6006bc';
$server_password = '0739b344';
$server_host = "us-cdbr-east-03.cleardb.com";
$database = 'heroku_eedca10c2fc1c8a';

$conn = mysqli_connect($server_host, $server_username, $server_password, $database) or die("cant connect to database");

function getData($conn, $categoryTitles) {
    $sql = "SELECT *
                        FROM business b, biz_category bc, category c
                        WHERE b.business_ID = bc.business_ID AND c.category_ID = bc. category_ID
                        AND c.title = " . "'" . $categoryTitles . "'";

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
    echo "<br>";
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
        table, th, td {
            border: 1px solid black;
        }

        #inputText {
            width: 30%;
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
            width:800px;
            margin:0 auto;
            padding: 20px 20px;
        }
    </style>
</head>
<body>
<h1>Search a business</h1>
<form autocomplete="off" name="searchForm" action="index.php" method="get">
    <input id="inputText" type="text" name="inputText" placeholder="Enter category to find business">
    <input type="submit" value="Search">
    <input type="reset" value="Clear text">
</form>
<script type="text/javascript">
    // Get the HTTP Object
    function getHTTPObject() {
        if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        } else if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        } else {
            alert("Your browser does not support AJAX.");
            return null;
        }
    }

    function inputSuggest(input) {
        input.addEventListener("input", (e) => {
            let a, b, i, val = input.value;
            closeAllLists();
            if (!val) {
                return false;
            }

            // Create a DIV element that will contain the items (values):
            a = document.createElement("div");
            a.setAttribute("id", input.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");

            input.parentNode.appendChild(a);

            // process AJAX
            httpObject = getHTTPObject();
            let obj;
            if (val && httpObject != null) {
                httpObject.open("GET", "./Suggestion.php?inputText=" + val, true);
                httpObject.send(null);
                httpObject.onreadystatechange = () => {
                    if (httpObject.readyState === 4 && httpObject.responseText) {
                        obj = JSON.parse(httpObject.responseText);
                        obj.forEach((i) => {
                            b = document.createElement("div");
                            b.setAttribute("style", "cursor:pointer");
                            b.innerHTML = i.title;
                            b.addEventListener("click", (e) => {
                                input.value = i.title;
                                closeAllLists();
                            });
                            a.appendChild(b);
                        });
                    }
                }
            }

            function closeAllLists(element) {
                let x = document.getElementsByClassName("autocomplete-items");
                for (let i = 0; i < x.length; i++) {
                    if (element !== x[i] && element !== input) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }

            document.addEventListener("click", () => {
                closeAllLists();
            });
        })
    }

    inputSuggest(document.getElementById("inputText"));
</script>
<?php
if (isset($_GET["inputText"])) {
    $categoryTitles = $_GET["inputText"];
    $bizcats = getData($conn, $categoryTitles);
    displayData($bizcats);
}
?>
</body>
</html>