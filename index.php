<html>
    <head>
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
            $access = isset($_COOKIE['access']) ? $_COOKIE['access'] : "";
            $login = isset($_COOKIE['login']);
            if (!$login) 
                header("Location:" . "http://localhost:81/Students/login.php");
            else {
                
                if($access != "g" && $access != "a" && $access != "e") {
                    header("Location:error.php?messerror=Access%20denied");
                    die();
                }
                else {
                    echo "<p class='acc'><a href='profile.php?id=" . $_COOKIE['login'] . "'>" . $_COOKIE['name'] . "</a></p>";
                    $conn = new mysqli("localhost", "root", "", "students");
                    if ($conn->connect_error) {
                        header("Location:error.php?messerror=" . $conn->connect_error);
                        die();
                    }
                    else {
                        $conn->query("set character_set_results='utf8'");  
                        $sql = "select * from students";

                        //print members
                        $result = $conn->query($sql);
                        echo "<table class='table'><tr><th colspan='5'><h2>Member list</h2></th></tr><tr><td>Id</td><td>Name</td><td>Class</td><td>Information</td><td>Note</td></tr><tr><td>";
                        while ($row = $result->fetch_assoc()) {
                            echo $row['id'] .
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
                }
            }
        ?>       
        </div>
    </body>
</html>