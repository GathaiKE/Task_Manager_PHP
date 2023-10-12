<?php

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Task_Manager";


$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("Connection to DB error :".$conn->connect_error);
}


if(isset($_GET['id'])){

    $taskId = $_GET['id'];

    $del_stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
    $del_stmt -> bind_param("i",$taskId);
    $del_stmt -> execute();

    if($del_stmt->execute()){
        echo "Task deleted successfully";
    } else {
        echo "Error :".$conn->error;
    }

}


$del_stmt->close();
$conn->close();

?>
