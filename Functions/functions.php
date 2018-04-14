<?php

    // This is a temporary way to define functions. I will use OOP instead in future
    // Sorry for this unfortunateness


    function isTheUsernameIsTheOnly($username) {
        $conn = new mysqli("localhost", "root", "", "Students");
        if ($conn->connect_error) {
            header("Location:error.php?messError=" . $conn->connect_error);
            die();
        }
        $result = $conn->query("select * from Users where username='" . $username . "'");
        return $result->num_rows == 0;
    }
    function isTheEmailIsTheOnly($email) {
        $conn = new mysqli("localhost", "root", "", "Students");
        if ($conn->connect_error) {
            header("Location:error.php?messError=" . $conn->connect_error);
            die();
        }
        $result = $conn->query("select * from Users where email='" . $email . "'");
        return $result->num_rows == 0;
    }
    function checkLogin() {
        if (!isset($_COOKIE['login']) || !isset($_COOKIE['name']) || !isset($_COOKIE['access'])) {
            header("Location:accessError.html?a=1");
            die();
        }
        $id = decode($_COOKIE['login']);
        $access = decode($_COOKIE['access']);
        $name = $_COOKIE['name'];
        $conn = new mysqli("localhost", "root", "", "students");
        $sql = "select * from Users where id=$id and access='$access'";
        $result = $conn -> query($sql);
        if ($result -> num_rows <= 0) {
            header("Location:accessError.html");
            die();
        }
    }
    function checkAccess() {
        if (!isset($_GET['access']) || !isset($_COOKIE['access']) || !isset($_COOKIE['login']))  {
            header("Location:accessError.html?a=1");
            die();
        }
        if ($_GET['access'] != "true" || (decode($_COOKIE['access']) != 'a' && decode($_COOKIE['access']) != 'e')) {
            header("Location:accessError.html?a=");
            die();
        }
        $id = decode($_COOKIE['login']);
        $access = decode($_COOKIE['access']);
        $conn = new mysqli("localhost", "root", "", "students");
        $sql = "select * from users where id=$id and access='$access'";
        $result = $conn -> query($sql);
        if ($result -> num_rows == 0) {
            header("Location:accessError.html?");
            die();
        }
    }

    //The decode and encode functions will be upgraded in future
    function decode($input) {
        return base64_decode($input);
    }
    function encode($input) {
        return base64_encode($input);
    }
?>