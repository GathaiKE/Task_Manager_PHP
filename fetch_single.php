<?php

$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Task_Manager";


$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("Connection to DB failed".$conn->connect_error);
}

if(isset($_GET['id'])){
    $taskId = $_GET['id'];

    $fetch_stmt = $conn->prepare("SELECT task FROM tasks WHERE id=?");
    $fetch_stmt->bind_param("i",$taskId);

    if($fetch_stmt->execute()){
        $result = $fetch_stmt->get_result();
        $taskData = $result->fetch_assoc();


        if($taskData){
            $task = $taskData["task"];
            echo json_encode($task);
        } else{
            echo "Task not found";
        }
    } else{
        echo "Error occured! $conn->error";
    }
}

?>
