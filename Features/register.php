<?php
    if (isset($_GET['filled'])) {
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['pass']) ? $_POST['pass'] : null;
        $rePassword = isset($_POST['rePass']) ? $_POST['rePass'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : "";
        $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : null;
        if (!$username || !$password || !$rePassword || !$email || !$nickname) {
            echo "<script>alert('Please fill all the required input.')</script>";
        }
        else {
            include("functions.php");
            if (strcmp($password, $rePassword) != 0) {
                echo "<script>alert('Password and re-entered are not the same.')</script>";
            }
            else if (strlen($password) < 8){
                echo "<script>alert('Your password must be at least 8 charaters.')</script>";
            }
            else if (!isTheUsernameIsTheOnly($username)) {
                echo "<script>alert('Username is contained in database, please try another username.'</script>";
            }
            else if (!isTheEmailIsTheOnly($email)) {
                echo "<script>alert('Email is being uses by another account, plaese try another email.')</script>";
            }
            else {
                $conn = new mysqli("localhost","root", "", "Students");
                $result = $conn->query("select * from Users");
                $id = $result->num_rows + 1;
                if ($conn->query("insert into Users values($id, '$nickname', '$name','$username', '$password', 'g', '$email')") === TRUE) {
                    header("Location:success.html");
                    die();
                }
                else {
                    header("Location:../Errors/error.php?messerror=" . $conn->error);
                    die();
                }                    
            }
        }
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Courier;
                font-weight: lighter;
                color: white;
            }
            h1 {
                text-align: center;
                font-weight: lighter;
                font-size: 3rem
            }
            .container {
                display: flex;
                justify-content: center; 
                align-items: center;
                flex-direction: column;
                background: #2c3e50;
                background: -webkit-linear-gradient(to right, #3498db, #2c3e50);
                background: linear-gradient(to right, #3498db, #2c3e50); 
                width: 100%;
                height: 100%;
            }
            .form {
                height: 95%;
                background: transparent;
                text-align: center;
                width: 750px;
            }
            .form input {
                outline: 0;
                width: 70%;
                padding: 10px;
                font-size: 18px;
                box-sizing: border-box;
                border-radius: 5px;
                color: white;
                margin: 15px 0;
                border: 0;
                background: rgba(255, 255, 255, 0.1)
            }
            .form label {
                margin: 0 10px 0 0;
                display: inline-block;
                width: 24%;
                text-align: right;
                font-size: 18px;
            }
            button {
                background: transparent;
                border: 1px solid white;
                color: inherit;
                margin: 10px;
                padding: 10px 20px;
                border-radius: 5px;
                font-size: 16px;
                font-weight: normal;
                cursor: pointer;
                transition: .3s ease;
            }
            button:hover {
                background: white;
                color: black;
            }
            span {
                font-weight: bold;
            }
            ::placeholder {
                color: lightgrey;
                opacity: 1; 
            }
            ::-ms-input-placeholder {
                color: lightgrey;
            }
            ::-ms-input-placeholder {
                    color: lightgrey;
            }
            @media only screen and (max-width: 700px) {
                .container {
                    height: 150%;
                }
                form {
                    width: 100%!important;
                }
                h1 {
                    font-size: 2.2rem;
                }
                .form label {
                    margin-bottom: 10px;
                    text-align: center;
                    width: 100%;
                }
                .form-control {
                    margin: 10px 0;
                }
                button {
                    margin: 10px 20px;
                }
                ::-webkit-scrollbar {
                    display: none;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form action="register.php?filled=true" method="post" class="form">
                <h1>Register</h1>
                <p>* Indicates a <span>required</span> input</p>
                <div class="form-control">
                    <label for="name">Your name: </label>
                    <input type="text" name="name" placeholder="Your name">
                </div>
                <div class="form-control">
                    <label for="nickname">Nickname*: </label>
                    <input type="text" name="nickname" placeholder="Nickname">
                </div>
                <div class="form-control">
                    <label for="username">Username*: </label>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="form-control">
                    <label for="pass">Password*: </label>
                    <input type="password" name="pass" placeholder="Password">
                </div>
                <div class="form-control">
                    <label for="rePass">Confirm password*: </label>
                    <input type="password" name="rePass" placeholder="Re-enter password">
                </div>
                <div class="form-control">
                    <label for="email">Email*:</label>
                    <input type="email" name="email" placeholder="Email">
                </div>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </body>
</html>