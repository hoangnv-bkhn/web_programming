<html>
    <head><title>Receiving Input</title></head>
    <style>
        * {
            box-sizing: border-box;
        }
        .container {
            border-radius: 5px;
            padding: 20px;
        }
    </style>
    <body>
    <div class="container">
        <?php
        $name = $_POST["name"];
        $class = $_POST["class"];
        $univ = $_POST["univ"];
        print ("<br>Hello, $name");
        print ("<br>You are studying at $class, $univ");
        print ("<br>Your hobby is:<br>");
        if(isset($_POST['hobbies'])) {
            $type = $_POST['hobbies'];
            $num = 1;
            foreach ($type as $hobby){
                print("$num. $hobby.<br />");
                $num++;
            }}
        if (isset($_POST['fav_language'])) {
            $fav = $_POST['fav_language'];
            print("Favorite Web language: $fav");
        }
        ?>
    </div>
    </body>
</html>



