<?php
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
    function checkAccess() {
        if (!isset($_GET['access']) || !isset($_COOKIE['access']) || !isset($_COOKIE['login']))  {
            header("Location:accessError.html");
            die();
        }
        if ($_GET['access'] != "true" && $_COOKIE['access'] != 'a' && $ $_COOKIE['access'] != 'e') {
            header("Location:accessError.html");
            die();
        }
    }
?>