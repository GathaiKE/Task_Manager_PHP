<?php

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Task_Manager";


$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("DB connection failed".$conn->connect_error);
}

if(isset($_POST["task"])){

    $updatedTask = $_POST["task"];
    $id = $_POST["id"];

    $update_stmt = $conn->prepare("UPDATE tasks SET task = ? WHERE id =$id");
    $update_stmt->bind_param("s",$updatedTask);

    if($update_stmt->execute()){
        echo "Update successfull";
    } else {
        echo "Update Error : ".$conn->error;
    }
} else {
    echo "Cannot set to blank";
}

$update_stmt->close();
$conn->close();
?>
