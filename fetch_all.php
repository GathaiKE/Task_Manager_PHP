<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$server = "localhost";
$user="admin";
$password="Admin@123";
$db="Task_Manager";

$tasks = array();

$conn = new mysqli($server, $user, $password, $db);

$get_stmt = $conn->prepare("SELECT * FROM tasks");

if(!$get_stmt){
    die("Prepare failed");
}

$result = $get_stmt->get_result();

if($result->num_rows > 0){
    while($task = $result->fetch_assoc()){
        $tasks[]= $task;
    }
}



$get_stmt->close();
$conn->close();


echo json_encode($tasks);
?>