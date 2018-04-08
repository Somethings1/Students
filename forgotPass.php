<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                padding: 0;
                margin: 0;
                font-family: 'Segoe UI', Verdana, Courier;
                font-weight: lighter;
            }
            .container {
                align-items: center;
                display: flex;
                flex-direction: column;
                padding-top: 100px;
            }
            h1 {
                font-size: 3rem;
                text-align: center;
            }
            form {
                width: 700px;
            }
            .form-control {
                align-items: center;
                display: flex;
                margin: 20px 0;
                width: 100%;
            }
            label {
                box-sizing: border-box;
                display: inline-block;
                font-size: 18px;
                font-weight: normal;
                padding-right: 10px;
                text-align: right;
                width: 25%
            }
            input {
                border: 1px solid black;
                border-radius: 5px;
                display: inline-block;
                font-size: 18px;
                padding: 5px 10px;
                transition: .5s ease;
                width: 70%;
            }
            input:focus {
                outline: none;
                padding: 10px 15px;
            }
            .mess {
                padding-left: 25%;
            }
            .btn {
                background-color: white;
                border: 1px solid black;
                border-radius: 5px;
                cursor: pointer;
                font-size: 18px;
                margin: 20px;
                padding: 5px 10px;
            }
            .btn:hover {

            }
            .form-control-btn {
                justify-content: center;
            }
            .error {
                color: red;
                font-weight: normal;
                text-align: center;
            }
            @media only screen and (max-width: 650px) {
                .container {
                    padding-top: 50px;
                }
                form {
                    width: 100%;
                }
                .form-control {
                    flex-direction: column;
                }
                label {
                    text-align: center;
                    width: 100%
                }
                input {
                    width: 90%;
                }
                .btn {
                    margin: 10px 20px;
                }
                .mess {
                    padding: 0 10px;
                }
                .form-control-btn {
                    flex-direction: row;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Forgot password</h1>
            <form action="forgotPass.php?filled=true" method="post">
                <div class="form-control">
                    <label for="username">Your username</label>
                    <input type="text" name="username">
                </div>
                <div class="form-control" style="flex-direction:column">
                    <p class="mess">A verify code will be sent to your email account that you entered when registering.</p>
                    <p class="mess">Please check the inbox (also check in "Spam" section) to get the code and fill in the form below</p>
                </div>
                <div class="form-control">
                    <label for="code">Verify code</label>
                    <input type="number" name="code">
                </div>
                <div class="form-control form-control-btn">
                    <button class="btn">Submit</button>
                    <button class="btn" onClick="window.history.back(1)">Cancel</button>
                </div>
                <?php
                    $username = isset($_POST['username']) ? $_POST['username'] : null;
                    if ($_GET['filled'] === "true") {
                        if (!$username) {
                            echo "<p class='error'>Please press your username.</p>";
                            die();
                        }
                        else {
                            $conn = new mysqli("localhost", "root", "", "students");
                            if ($conn -> connect_error) {
                                header("Location:error.php?messerror=" . $conn -> connect_error);
                                die();
                            }
                            if (!isset($_POST['code'])) {
                                $result = $conn -> query("select * from students where username='$username'");
                                if (!$result || $result -> num_rows <= 0) {
                                    echo "<p class='error'>Username you've entered does not fit any.</p>";
                                    die();
                                }
                                $to      = $result -> fetch_assoc();
                                $to      = $to['email'];
                                $subject = 'Verify code from Localhost'; // Change subject if you want
                                $message = rand(100000, 999999); // Generate a random number with 6 of length
                                $headers = 'From: somethings.ttt@gmail.com' . "\r\n" . // Change to your website email
                                    'Reply-To: somethings.ttt@gmail.com' . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();                            
                                mail($to, $subject, $message, $headers);
                                setcookie("code", base64_encode($message), "/");
                            }
                            else {
                                if ($_POST['code'] !== base64_decode($_COOKIE['code'])) {
                                    echo "<p class='mess'>Passcode is incorrect, please try again.</p>";
                                }
                                else {
                                    $rand = rand(10000000, 99999999);
                                    $sql = "update students set pass='$rand' where username='$username'";
                                    echo "<script>alert('Your password is now changed to \\'$rand\\', change it in your profile page');window.location = 'login.php';</script>";
                                }
                            }
                        }
                    }                    
                ?>
            </form>
        </div>
    </body>
</html>