<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            $access = isset($_COOKIE['login']);
            if(!$access || ($access != "g" && $access != "a" && access != "e")) {
                header("Location:" . "http://localhost:81/Students/login.php");
                die();
            }
        ?>       
    </body>
</html>