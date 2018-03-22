<html>
    <head>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Roboto, Courier;
                font-weight: lighter;
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
                background: #FFFFFF;
                max-width: 360px;
                margin: 0 auto 100px;
                padding: 30px 45px 45px 45px;
                text-align: center;
                box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
            }
            .form input {
                font-family: "Roboto", sans-serif;
                outline: 0;
                background: #f2f2f2;
                width: 100%;
                border: 0;
                margin: 15px 0;
                padding: 15px;
                box-sizing: border-box;
                font-size: 14px;
            }
            .form button {
                font-family: "Roboto", sans-serif;
                text-transform: uppercase;
                outline: 0;
                background: #4CAF50;
                width: 100%;
                border: 0;
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
                font-size: 2rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="form">
                <form class="login-form" action="login.php?filled=true" method="post">
                    <h1>Login to your account</h1>
                    <input type="text" placeholder="Username" name="username"/>
                    <input type="password" placeholder="Password" name="password"/>
                    <button type="submit">login</button>
                    <p class="message">Not registered? <a href="#">Create an account</a></p>
                </form>
            </div>
        </div>
        <?php
            $name = isset($_POST["username"]) ? $_POST["username"] : null;
            $password = isset($_POST["password"]) ? $_POST["password"] : null;
            $filled = isset($_GET["fill"]) ? $_GET["fill"] : null;
            if ($filled != null) {
                if ($name == null || $password == null) {
                    echo "<p>Please fill all the form</p>"
                } 
                else {

                }
            }
        ?>
    </body>
</html>