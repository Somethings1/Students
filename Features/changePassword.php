<?php
    include "../Functions/functions.php";
    checkLogin();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <title>Change password</title>
        <style>
            * {
                margin: 0;
                padding: 0;
                font-family: 'Segoe UI', Verdana, Courier;
                font-weight: lighter;
                color: white;
            }
            h1 {
                margin-bottom: 20px;
                text-align: center;
                font-weight: lighter;
                font-size: 3rem
            }
            .container {
                display: flex;
                justify-content: center; 
                align-items: center;
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
                form {
                    width: 100%!important;
                }
                h1 {
                    font-size: 2.2rem;
                }
                .form label {
                    display: block;
                    text-align: center;
                    width: 100%;
                }
                .form-control {
                    margin: 20px 0;
                }
                .button {
                    margin: 10px 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form action="changePassword.php?filled=true" class="form" method="post">
                <h1>Change password</h1>
                <p>* Indicates a <span>required</span> input</p>
                <div class="form-control">
                    <label for="old">Your current password*: </label>
                    <input type="password" name="old" placeholder="Your current password">
                </div>
                <div class="form-control">
                    <label for="new">New password*: </label>
                    <input type="password" name="new" placeholder="New password (At least 6 characters)">
                </div>
                <div class="form-control">
                    <label for="renew">Username*: </label>
                    <input type="password" name="renew" placeholder="Re-enter your password">
                </div>
                <div class="form-control">
                    <button type="button" class="button" onClick="window.history.back(1)">Cancel</button>
                    <button type="submit" class="button">Submit</button>
                </div>
            </form>
        </div>
        <?php
            if (isset($_GET['filled']) && $_GET['filled'] == "true") {
                $old = isset($_POST['old']) ? $_POST['old'] : null;
                $new = isset($_POST['new']) ? $_POST['new'] : null;
                $reNew = isset($_POST['renew']) ? $_POST['renew'] : null;
                if (!$old || !$new || !$reNew) {
                    echo "<script>alert('Please fill all the form.')</script>";
                    die();
                }
                else {
                    $conn = new mysqli("localhost", "root", "", "students");
                    $id = decode($_COOKIE['login']);
                    $sql = "select * from users where pass='$old' and id=$id";
                    $result = $conn -> query($sql);
                    if ($result -> num_rows == 0) {
                        echo "<script>alert('Your password is not correct. Please check again.')</script>";
                        die();
                    } 
                    if (strlen($new) < 6) {
                        echo "<script>alert('Your password must be at least 6 characters.')</script>";
                        die();
                    }
                    if ($new != $reNew) {
                        echo "<script>alert('Re-enter is not the same with new password. Please chekc again')</script>";
                        die();
                    }                   
                    $sql = "update users set pass='$new' where id=$id";
                    if ($conn -> query($sql) === FALSE) {
                        header("Location:../Errors/error.php?messerror=" . $conn -> error);
                        die();
                    }
                    echo "<script>alert('Your password was changed successfully.');window.location = '../index.php'</script>";
                }
            }
        ?>
    </body>
</html>