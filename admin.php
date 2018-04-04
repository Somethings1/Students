<?php
    include "functions.php";
    checkAccess();
?>
<html>
    <head>
        <title>Configuring page for administrators</title>
        <meta charset="utf-8">
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
                flex-direction: column;   
                background: #fe8c00;
                background: -webkit-linear-gradient(to left, #f83600, #fe8c00);
                background: linear-gradient(to left, #f83600, #fe8c00);      
                width: 100%;
                height: 100%;
            }
            .btn {
                background: transparent;
                border: 1px solid white;
                border-radius: 5px;
                box-sizing: border-box;
                color: white;
                cursor: pointer;
                display: inline-block;
                font-size: 18px;
                margin: auto 50px;
                padding: 5px 10px;
                text-align: center;
                text-decoration: none;
                transition: .5s ease;
                width: 80px;
            }
            .btn:hover {
                background: white;
                color: black;
            }
            h1 {
                font-size: 3rem;
                text-align: center;
            }
            .check {
                background: red;
                width: 500px;
                height: 500px;
            }
            .form {
                align-items: center;
                background: transparent;
                display: flex;
                flex-direction: column;
                justify-content: center;
                width: 700px;
            }
            .form-control {
                margin: 20px 0;
                text-align: center;
                width: 90%;
            }
            .form-control-button {
                width: 100%;
            }
            input {
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid white;
                border-radius: 5px;
                font-size: 18px;
                padding: 7px;
                transition: .5s ease;
                width: 80%;
            }
            input:focus {
                background: #fff;
                color: #250025;
                outline: none;
            }
            ::placeholder {
                color: lightgrey;
            }
            label {
                display: inline-block;
                font-size: 18px;
                margin: 0 10px 0 0;
                text-align: right;
                width: 17%;
            }
            @media only screen and (max-width: 700px) {
                form {
                    width: 100%!important;
                }
                h1 {
                    font-size: 2rem;
                }
                label {
                    margin-bottom: 10px;
                    text-align: center;
                    width: 100%;
                }
                .form-control {
                    margin: 10px 0;
                }
                .btn {
                    margin: auto 20px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
        <?php
            if (!isset($_GET['choice'])){
        ?>
            <h1>Choose one action with member list</h1>
            <div class='first'>
                <a href='admin.php?access=true&choice=add' class='btn'>Add</a>
                <a href='admin.php?access=true&choice=modify' class='btn'>Modify</a>
                <a href='admin.php?access=true&choice=delete' class='btn'>Delete</a>
            </div>
        <?php
            }
            else if ($_GET['choice'] === 'add') {
        ?>
            <form action="addStudent.php" method="post" class="form">
                <h1>Add a student</h1>
                <div class="form-control">
                    <label for="name">Full name</label>
                    <input type="text" name="name" placeholder="Full name">
                </div>
                <div class="form-control">
                    <label for="class">Class</label>
                    <input type="text" name="class" placeholder="Class">
                </div>
                <div class="form-control">
                    <label for="info">Informations</label>
                    <input type="text" name="info" placeholder="Information">
                </div>
                <div class="form-control">
                    <label for="note">Note</label>
                    <input type="text" name="note" placeholder="Note">
                </div>
                <div class="form-control form-control-button">
                    <button type="submit" class="btn">Submit</button>
                    <a href="#" class="btn" onClick="window.history.back(1)">Cancel</a>
                </div>
            </form>
        <?php
            }
            else if ($_GET['choice'] === 'modify') {
        ?>
            <form action="modifyStudent.php" method="post" class="form">
                <h1>Modify informations of a student</h1>
                <p>*Leave blank to keep old information</p>
                <div class="form-control">
                    <label for="name">Id</label>
                    <input type="text" name="name" placeholder="Id of student to change">
                </div>
                <div class="form-control">
                    <label for="name">Full name</label>
                    <input type="text" name="name" placeholder="Full name">
                </div>
                <div class="form-control">
                    <label for="class">Class</label>
                    <input type="text" name="class" placeholder="Class">
                </div>
                <div class="form-control">
                    <label for="info">Informations</label>
                    <input type="text" name="info" placeholder="Information">
                </div>
                <div class="form-control">
                    <label for="note">Note</label>
                    <input type="text" name="note" placeholder="Note">
                </div>
                <div class="form-control form-control-button">
                    <button type="submit" class="btn">Submit</button>
                    <a href="#" class="btn" onClick="window.history.back(1)">Cancel</a>
                </div>
            </form>
        <?php
            }
            else if ($_GET['choice'] === 'delete') {
        ?>
            <form action="deleteStudent.php" method="post" class="form">
                <h1>Remove a student from list</h1>
                <div class="form-control">
                    <label for="name">Id</label>
                    <input type="text" name="name" placeholder="Id of student to remove">
                </div>
                <div class="form-control form-control-button">
                    <button type="submit" class="btn">Submit</button>
                    <a href="#" class="btn" onClick="window.history.back(1)">Cancel</a>
                </div>
            </form>
        <?php
            }
            else {
                header("Location:error.php");
                die();
            }
        ?>
        </div>
    </body>
</html>