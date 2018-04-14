<?php

    // Check if user didn't enter an ID
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    if (!$id) {
        echo "<script>alert('You must enter an ID.');window.history.back(1)</script>";
        die();
    }

    // Make connect and get data
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn -> connect_error) {
        header("Location:../Errors/error.php?messerror=" . $conn -> connect_error);
        die();
    }
    $conn->set_charset("utf8");
    $sql = "select * from students where id=$id";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    $name = $_POST['name'] !== "" ? $_POST['name'] : $row['name'];
    $class = $_POST['class'] !== "" ? $_POST['class'] : $row['class'];
    $info = $_POST['info'] !== "" ? $_POST['info'] : $row['info'];
    $note = $_POST['note'] !== "" ? $_POST['note'] : $row['note'];
    $sql = "update students set name='$name', class='$class', info='$info', note='$note' where id=$id";
    // Modify and check connect 
    if ($conn -> query($sql) === FALSE) {
        header("Location:../Errors/error.php?messerror=" . $conn -> error);
        die();
    }
    echo "<script>alert('The information has been changed successfully.');window.history.back(1)</script>";

?>