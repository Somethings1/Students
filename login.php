<html>
    <head>
        <title>Login to your account</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Roboto, Courier;
                font-weight: lighter;
                color: white;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: rgb(10, 4, 39);
                width: 100%;
                height: 100%;
            }
            .form {
                position: relative;
                z-index: 1;
                background: rgb(10, 4, 39);
                width: 400px;
                padding: 30px 45px 45px 45px;
                text-align: center;
                /*box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);*/
            }
            .form input {
                font-family: "Roboto", sans-serif;
                outline: 0;
                background: rgba(255, 255, 255, 0.1);
                width: 100%;
                border: 0;
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
                position: fixed;
                color: white;
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
                    <p style="color: white;margin-top:25px;">Not registered? <a href="#" style="color:orange;text-decoration:none">Create an account</a></p>
                </form>
            </div>
            <?php
                $name = isset($_POST["username"]) ? $_POST["username"] : null;
                $password = isset($_POST["password"]) ? $_POST["password"] : null;
                $filled = isset($_GET["filled"]) ? $_GET["filled"] : null;
                if ($filled != null) {
                    if ($name == null || $password == null) {
                        if ($password == null) 
                            echo "<p class='mess'>Password is required</p>";
                        else 
                            echo "<p class='mess'>Username is required</p>";
                    } 
                    else {
                        $conn = new mysqli("localhost", "root", "", "students");
                        if ($conn->connect_error) {
                            header("Location:error.php?messerror=" . $conn->connect_error);
                            die();
                        }
                        $sql = "select * from users where username='" . $name . "'";
                        $result = $conn->query($sql);
                        if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            if ($row['pass'] === $password) {
                                setcookie("login", $row["id"], time() + (86400 * 30), "/");
                                setcookie("access", $row["access"], time() + (86400 * 30), "/"); 
                                header("Location:index.php");   
                            }
                            else {
                                echo "<p class='mess'>Password is not correct. <a>Forgot password?</a></p>";
                            }
                        }
                        else {
                            echo "<p class='mess'>Your username does not fit any.</p>";
                        }
                    }
                }
            ?>
        </div>
    </body>
</html>