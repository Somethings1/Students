<?php

    // Connect and check conenction
    $conn = new mysqli("localhost", "root", "", "students");
    if ($conn -> connect_error) {
        header("Location:error.php?messerror=" . $conn -> connect_error);
        die();
    }

    // Get id and check if it is null
    $id = $_POST['id'] !== "" ? $_POST['id'] : null;
    if (!$id) {
        echo "<script>alert('Please enter an ID to delete.');window.history.back(1);</script>";
        die();
    }
    $sql = "delete from student where id=$id";
    if ($conn -> query($sql) === FALSE) {
        header("Location:error.php?messerror=" . $conn -> error);
        die();
    }
    echo "<script>alert('Informations of the student has id = $id have been deleted.');window.history.back(1)</script>";
?>