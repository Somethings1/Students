<html>
    <head>
        <title>Member list</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            * {
                padding: 0;
                margin: 0;
                font-family: 'Segoe UI', Verdana, Roboto, Courier;
            }
            body {
                display: flex;
                justify-content: center;
            }
            .container {
                width: 90%;
            }
            th {
                text-align: center;
            }
            .table {
                margin-top: 30px;
            }
            .acc {
                position: fixed;
                right: 10px;
            }
        </style>
        <script>
            
        </script>
    </head>
    <body>
        <div class="container">
        <?php
            include "Functions/functions.php";
            $access = isset($_COOKIE['access']) ? decode($_COOKIE['access']) : null;
            $login = isset($_COOKIE['login']) ? decode($_COOKIE['login']) : null;
            if (!$login)  {
                header("Location:Features/login.php");
                die();
            }
            else {                
                checkLogin();
                echo "<p class='acc'><a href='Features/profile.php?id=" . $login . "'>" . $_COOKIE['name'] . "</a></p>";
                $conn = new mysqli("localhost", "root", "", "students");
                if ($conn->connect_error) {
                    header("Location:error.php?messerror=" . $conn->connect_error);
                    die();
                }
                $conn->query("set character_set_results='utf8'");  
                $sql = "select * from students";

                //print members
                $result = $conn->query($sql);
                $res = [];
                echo "<table class='table'><tr><th colspan='5'><h2>Member list</h2></th></tr><tr><td>Id</td><td>Name</td><td>Class</td><td>Information</td><td>Note</td></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" .
                        $row['id'] .
                        "</td><td>" . 
                        $row['name'] . 
                        "</td><td>" . 
                        $row['class'] . 
                        "</td><td>" . 
                        $row['info'] . 
                        "</td><td>" . 
                        $row['note'] . 
                        "</td></tr>";
                }
                echo "</table>";                 
            }
        ?>       
        </div>
    </body>
</html>