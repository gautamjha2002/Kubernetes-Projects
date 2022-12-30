<?php

// Connect to the database server
$host = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$port = 3306;
$dbname = "tododb";
$tablename = "tasks";



$conn = mysqli_connect($host, $username, $password, $dbname,$port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the task id from the URL
$id = $_GET["id"];

// Fetch the task details from the database
$sql = "SELECT * FROM tasks WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $taskname = $row["taskname"];
    $date = $row["date"];
    $taskdescription = $row["taskdescription"];
} else {
    echo "Task not found";
}

// Close the connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/add.css">
    <title>Document</title>
</head>
<body>
<div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="tasks.php">Home</a>
        <a href="add.html">Add Task</a>
        
      </div>
      <h2>Edit Task</h2>
      <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button>  
      </div> 
<!-- Display the task details in a form -->
<form  action="update.php" method="post" >
  <label for="taskname">Taskname:</label><br>
  <input type="text" id="taskname" name="taskname" value="<?php echo $taskname; ?>"><br>
  <label for="date">Date:</label><br>
  <input type="date" id="date" name="date" value="<?php echo $date; ?>"><br>
  <label for="taskdescription">Task Description:</label><br>
  <textarea id="taskdescription" name="taskdescription"><?php echo $taskdescription; ?></textarea><br>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="submit" value="Update">
</form>
</body>
<script src="index.js"></script>
</html>