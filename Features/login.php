<html>
    <head>
        <title>Login to your account</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Courier;
                font-weight: lighter;
                color: white;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                background: #005C97;
                background: -webkit-linear-gradient(to right, #363795, #005C97); 
                background: linear-gradient(to right, #363795, #005C97);                
                width: 100%;
                height: 100%;
            }
            .form {
                position: relative;
                z-index: 1;
                background: transparent;
                width: 400px;
                height: 70%;
                padding: 30px 45px 45px 45px;
                text-align: center;
            }
            .form input {
                font-family: "Roboto", sans-serif;
                outline: 0;
                background: rgba(255, 255, 255, 0.1);
                width: 100%;
                border: 0;
                border-radius: 5px;
                margin: 15px 0;
                padding: 15px;
                box-sizing: border-box;
                font-size: 14px;
                color: white;
            }
            .form button {
                font-family: "Roboto", sans-serif;
                text-transform: uppercase;
                outline: 0;
                background: #4CAF50;
                width: 100%;
                border: 0;
                border-radius: 5px;
                margin-top: 25px;
                padding: 15px;
                color: #FFFFFF;
                font-size: 14px;
                -webkit-transition: all 0.3 ease;
                transition: all 0.3s ease;
                cursor: pointer;
            }
            .form button:hover,.form button:active,.form button:focus {
                background: #43A047;
            }
            h1 {
                font-size: 2.5rem;
            }
            .mess {
                color: white;
                position: fixed;
                text-align: center;
                top: 550px;
                z-index: 999;
            }
            a {
                color: orange;
                text-decoration: none;
            }
            a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="form">
                <form class="login-form" action="login.php?filled=true" method="post">
                    <h1 style="color:white">Login to your account</h1>
                    <input type="text" placeholder="Username" name="username" style="margin-top: 25px;"/>
                    <input type="password" placeholder="Password" name="password"/>
                    <button type="submit">login</button>
                    <p style="color: white;margin-top:25px;">Not registered? <a href="register.php">Create an account</a></p>
                </form>
            </div>
            <?php
                include "../Functions/functions.php";
                $name = isset($_POST["username"]) ? $_POST["username"] : null;
                $password = isset($_POST["password"]) ? $_POST["password"] : null;
                $filled = isset($_GET["filled"]) ? $_GET["filled"] : null;
                if (isset($_COOKIE['login']) && isset($_COOKIE['access'])) {
                    header("Location:../index.php");
                }

                // When user press submit
                if ($filled != null) {

                    // If user didn't press password of username
                    if ($name == null || $password == null) {
                        if ($password == null) 
                            echo "<p class='mess'>Password is required</p>";
                        else 
                            echo "<p class='mess'>Username is required</p>";
                    } 
                    else {
                        $conn = new mysqli("localhost", "root", "", "students");
                        if ($conn->connect_error) {
                            header("Location:../Errors/error.php?messerror=" . $conn->connect_error);
                            die();
                        }
                        $conn->query("set character_set_results='utf8'"); 
                        $sql = "select * from users where username='" . $name . "'";
                        $result = $conn->query($sql);
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            if ($row['pass'] === $password) {
                                setcookie("login", encode($row['id']), time() + (86400 * 30), "/");
                                setcookie("access", encode($row['access']), time() + (86400 * 30), "/");
                                setcookie("name", $row['nickname'], time() + (86400 * 30), "/"); 
                                header("Location:../index.php");   
                            }
                            else {
                                echo "<p class='mess'>Password is not correct. <a href='forgotPass.php?filled=false'>Forgot password?</a></p>";
                            }
                        }
                        else {
                            echo "<p class='mess'>The username you entered does not fit any.</p>";
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>