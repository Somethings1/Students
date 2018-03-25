<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
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
                flex-direction: column;
                padding-top: 70px;
                background: linear-gradient(135deg, rgba(85,239,203,1) 0%,rgba(30,87,153,1) 0%,rgba(85,239,203,1) 0%,rgba(91,202,255,1) 100%);
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
                display: block;
                font-size: 16px;
                text-align: center;
                font-weight: 400;
                line-height: 45px;
                margin: 30px auto!important;
                max-width: 160px;
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
                letter-spacing: 5px;
            }
            @media (min-width: 400px) {
                .btn {
                    display: inline-block;
                    margin-right: 2.5em;
                }
                .btn:nth-of-type(even) {
                    margin-right: 0;
                }
            }
            .btn-2 {
                letter-spacing: 0;
            }

            .btn-2:hover,
            .btn-2:active {
                letter-spacing: 5px;
            }

            .btn-2:after,
            .btn-2:before {
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                border: 1px solid rgba(255, 255, 255, 0);
                bottom: 0px;
                content: " ";
                display: block;
                margin: 0 auto;
                position: relative;
                -webkit-transition: all 280ms ease-in-out;
                transition: all 280ms ease-in-out;
                width: 0;
            }

            .btn-2:hover:after,
            .btn-2:hover:before {
                -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
                border-color: #fff;
                -webkit-transition: width 350ms ease-in-out;
                transition: width 350ms ease-in-out;
                width: 70%;
            }

            .btn-2:hover:before {
                bottom: auto;
                top: 0;
                width: 70%;
            }
            .home {
                color: orange;
                text-decoration: none;
                position: fixed;
                top: 10px;
                left: 10px;
                transition: .3s ease;
            }
            .home:hover {
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php
                if (!$_COOKIE['login']) echo "<h1>You need to login to use this feature. <a href='login.php'>Login</a></h1>";
                else if ($_COOKIE['login'] != $_GET['id']);
                else {
                    echo "<img src='guest.png'/>";
                    
                    //connect to server
                    $conn = new mysqli("localhost", "root", "", "Students");
                    if ($conn->connect_error) {
                        header("Location:error?messError=" . $conn->connect_error);
                        die();
                    }
                    $conn->query("set character_set_results='utf8'"); 
                    $result = $conn->query("select * from Users where id=" . $_GET['id']);
                    $row = $result->fetch_assoc();
                    $access = $row['access'] == "g" ? "Guest" : $row['access'] == "a" ? "Admin" : "Extra Admin";

                    //Print info
                    echo "<p class='access'>" . $access . "</p>";
                    echo "<p class='nickname'>" . $row['nickname'] . "</p>";
                    echo "<a class='btn btn-1' href='index.php'>Home</a>";
                    echo "<a class='btn btn-2' href='logout.html'>Logout</a>";
                }
            ?>  
        </div>
    </body>
</html>