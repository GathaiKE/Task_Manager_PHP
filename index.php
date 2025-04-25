<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$title = "Taskly Task Manager.";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Task Manager</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="ajax.js" defer></script>
    </head>
    <body>
        <div class="container">
        <div class="app">
            <h2><?php echo $title ?></h2>
            <form action="insert.php" method="post">
                <label for="input">Task :</label>
                <input type="text" id="task" name="task" placeholder="Enter your task here">
                <button type="submit" id="submit">Submit</button>
            </form>
            <ul id="list"></ul>
        </div>
        </div>

    </body>
</html>