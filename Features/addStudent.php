<?php
    // Connect and check
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn -> connect_error) {
        header("Location:../Errors/error.php?messerror=" . $conn->connect_error);
        die();
    }

    //Get informations, and modify
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $class = isset($_POST['class']) ? $_POST['class'] : null;
    $info = isset($_POST['info']) ? $_POST['info'] : null;
    $note = isset($_POST['note']) ? $_POST['note'] : null;
    if (!$name || !$class || !$info || !$note) {
        echo "<script>alert('Every fields must be filled.');window.history.back(1)</script>";
        die();
    }
    // Start query
    $conn->set_charset("utf8");
    $query = "select * from students where 1";
    if ($conn -> query($query) === FALSE) {
        header("Location:../Errors/error.php?messerror=" . $conn -> error);
        die();
    }

    $result = $conn -> query($query);
    $id = ($result -> num_rows) + 1;
    $query = "insert into Students values($id, '$name', '$class', '$info', '$note')";
    if ($conn -> query($query) === FALSE) {
        header("Location:../Errors/error.php");
        die();
    }
    echo "<script>alert('New student was added to list successfully.');window.history.back(1)</script>";
?>