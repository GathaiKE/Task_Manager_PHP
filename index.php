

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
$server = "localhost";
$user = "admin";
$password = "Admin@123";
$db = "Task_Manager";

$title = "Taskly Task Manager.";
$task;
$status = 0;
$tasks = array();
$err;
$id;

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["task"])){
    if(empty($_POST["task"])){
        $err = "Cannot add an empty task";
    } else{
        $task = validate_data($_POST["task"]);
    }

    $conn = new mysqli($server, $user, $password, $db);
    
    if($conn->connect_error){
        die("Database connection failed!". $conn->connect_error);
    }

    $post_stmt=$conn->prepare("INSERT INTO tasks(task,complete) VALUES(?,?)");
    if(!$post_stmt){
        die("Insert prepare failed!".$conn->error);
    }
    $post_stmt->bind_param("si",$task,$status);
    $post_stmt->execute();

    $get_stmt = "SELECT id,task,complete,entry_date FROM tasks";
    $result = $conn->query($get_stmt);

}

function validate_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
</head>
<body>
    <div>
        <h2><?php echo $title ?></h2>
        <form action="<?PHP echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="input">Task :</label>
            <input type="text" id="task" name="task" placeholder="Enter your task here">
            <?php 
                if(!empty($err)){
                    echo "<span class='error'>". $err."</span>";
                }
            ?>
            <input type="submit" id="submit" value="Submit">
        </form>
        <ul>
            <li>
                <?php
                    if( $result -> num_rows > 0){
                        while($t = $result->fetch_assoc()){
                            $id = $t["id"];
                            echo $t["task"]."   <button onClick='preload($id)'>Edit</button> <button onClick='delete_task($id)'>Del</button>"."<br>";
                        }
                    } else{
                        echo "Task list empty!";
                    }
                ?>
            </li>
        </ul>
    </div>

    <script>
        
        let input = document.getElementById("task")
        let updateBtn = document.getElementById("submit")

        function preload(id){
            let xmlHttp = new XMLHttpRequest();

            xmlHttp.onreadystatechange = function (){
                if(this.readyState == 4 && this.status == 200){
                    input.value = this.responseText
                }
            }
            xmlHttp.open("GET","fetch_single.php?id="+id,true);
            xmlHttp.send();

            updateBtn.value = "Update"
        }

        

        function delete_task(id){
            let xmlhttp = new XMLHttpRequest();

            xmlhttp.onreadystatechange=function () {
                if(this.readyState == 4 && this.status == 200){
                    let task = document.getElementById("task-"+id)
                    
                    if(task){
                        task.remove();
                    }
                }
            }
            xmlhttp.open("POST","delete_task.php?id="+id,true);
            xmlhttp.send();
        }

    </script>
</body>
</html>
