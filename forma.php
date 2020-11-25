<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die (mysqli_error($mysqli));

$update = false;
$task = '';


if (isset($_POST['save'])){
    $task = $_POST['task'];

    $mysqli->query("INSERT INTO data (task) VALUES('$task')") or
    die($mysqli->error);

    $_SESSION['message'] = "Pakeitimai Išsaugoti";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "Ištrinta";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");

}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $task = $row['task'];

    }
}