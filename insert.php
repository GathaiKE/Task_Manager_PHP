<?php
header("Location: index.php?status=$feedback");
exit();


$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Task_Manager";


$task;
$complete = 0;
$feedback;

if($_SERVER["REQUEST_METHOD"] && isset($_POST["task"])){
    if(empty($_POST["task"])){
        $err= "Cannot add an empty task!";
    } else{
        $task = validate_data($_POST["task"]);
    }
}

$conn = new mysqli($server, $user, $password, $db);

if($conn->connect_error){
    die("Connection failed".$conn->connect_error);
}


$stmt=$conn->prepare("INSERT INTO tasks (task, complete) VALUES (?,?)");

if(!$stmt){
    die("Statement prepare failed : ".$conn->error);
}
$stmt->bind_param("si", $task, $complete);

$stmt->execute();

$feedback = $err?$err :"Task added successfully";


function validate_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

$stmt->close();
$conn->close();
?>