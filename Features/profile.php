<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Profile</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Roboto, Courier;
                font-weight: lighter;
            }
            .container {
                display: flex;
                text-align: center;
                align-items: center;
                flex-direction: column;
                padding-top: 70px;
                background: #457fca;  
                background: -webkit-linear-gradient(to right, #5691c8, #457fca);
                background: linear-gradient(to right, #5691c8, #457fca);
                width: 100%;
                min-height: 100%;
                box-sizing: border-box;
                color:white;
            }
            img {
                border: solid 2px grey;
                width: 200px;
                display: block;
                margin: 0 auto;
            }
            .access {
                color: white;
                font-size: 1em;
                margin-top: 20px;
            }
            .nickname {
                font-size: 3em;
                margin-top: 20px;
            }
            .btn {
                color: #fff;
                cursor: pointer;
                display: inline-block;
                font-size: 14px;
                text-align: center;
                font-weight: 400;
                line-height: 45px;
                margin: 30px 20px!important;
                max-width: 260px;
                text-decoration: none;
                text-transform: uppercase;
                vertical-align: middle;
                width: 100%;
            }
            .btn-1 {
                border: solid 2px white;
                transition: all .3s ease;
            }
            .btn-1:hover {
                border: solid 2px #ff8106;
            }
            .login a {
                color: orange;
                text-decoration: none;
            }
            .login a:hover {
                text-decoration: underline;
            }
            .group-btn {
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php
                include "../Functions/functions.php";
                if (!isset($_COOKIE['login'])) echo "<h1 class='login'>You need to login to use this feature. <a href='../Features/login.php'>Login</a></h1>";
                else if (decode($_COOKIE['login']) != $_GET['id']) {
                    // In future, I will change this to: If a person want to see profile page of another user, he/she can see public info of that person
                    echo "<script>window.location = '/Errors/accessError.html';</script>";
                }
                else {
                    echo "<img src='../guest.png'/>";
                    
                    //connect to server
                    $conn = new mysqli("localhost", "root", "", "Students");
                    if ($conn->connect_error) {
                        header("Location:/Errors/error?messError=" . $conn->connect_error);
                        die();
                    }
                    $conn->query("set character_set_results='utf8'"); 
                    $result = $conn->query("select * from Users where id=" . decode($_COOKIE['login']));
                    $row = $result->fetch_assoc();
                    $access = $row['access'] == "g" ? "Guest" : $row['access'] == "a" ? "Admin" : "Extra Admin";

                    //Print info
                    echo "<p class='access'>" . $access . "</p>";
                    echo "<p class='nickname'>" . $row['nickname'] . "</p>";
                    echo "<div class='group-btn'>";
                    echo "<a class='btn btn-1' href='../index.php'>Home</a>";
                    if (decode($_COOKIE['access']) === "a" || decode($_COOKIE['access']) === "e") {
                        echo "<a class='btn btn-1' href='../admin.php?access=true'>Admin configuring page</a>";
                        if (decode($_COOKIE['access']) === "e") {
                            echo "<a class='btn btn-1' href='../exAd.php?access=true'>Extra Admin configuring page</a>";
                        }
                    }
                    echo "</div>";
                    echo "<div class='group-btn'>";
                    echo "<a class='btn btn-1' href='changePassword.php'>Change password</a>";
                    echo "<a class='btn btn-1' href='logout.php'>Logout</a>";
                    echo "</div>";
                }
            ?>  
        </div>
    </body>
</html>