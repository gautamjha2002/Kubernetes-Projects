<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>To Do App</title>
</head>
<body>

<div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="tasks.php">Home</a>
        <a href="add.html">Add Task</a>
        
      </div>
      <h2>Your Tasks</h2>
      <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button> 
        
      </div> 

        <?php

// Connect to the database server
$host = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$port = 3306;
$dbname = "tododb";
$tablename = "tasks";



$conn = mysqli_connect($host, $username, $password, $dbname,$port);
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

        // Write a SELECT query to check if the table is empty
        $sql = "SELECT * FROM $tablename";
        $result = mysqli_query($conn, $sql);
        
        // If the table is empty, display the button
        if (mysqli_num_rows($result) == 0) {
           echo  '<a href="add.html" class="button" style=" margin: 1%; align-items: center; justify-content: center; display: inline-block; padding: 10px 20px; background-color: #4caf50; color: white; border: none; border-radius: 4px; text-decoration: none; cursor: pointer; font-size: 16px;
           " >Add Data</a>';
        }


      // Fetch the data from the database
$sql = "SELECT * FROM $tablename";
$result = mysqli_query($conn, $sql);


// Display the data in an HTML table

echo "<table class='responsive-table' style='width:100%; border-collapse:collapse; @media screen and (max-width: 600px) {
  .responsive-table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
  }
  .responsive-table td,
  .responsive-table th {
    display: block;
    width: auto;
    text-align: left;
  }'>";
echo "<tr>";
echo "<th style='text-align: left;padding: 8px;'>Taskname</th>";
echo "<th style='text-align: left;padding: 8px;'>Date</th>";
echo "<th style='text-align: left;padding: 8px;'>Task Description</th>";
echo "<th style='padding:8px;'>Action1</th>";
echo "<th style='padding:8px;'>Action2</th>";
echo "</tr>";

    


if (mysqli_num_rows($result) > 0) {

   $i = 0;
    // Output the data for each row
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id"];
        $taskname = $row["taskname"];
        $date = $row["date"];
        $taskdescription = $row["taskdescription"];


        if ($i % 2 == 0) {
            $style = "style='background-color:#f2f2f2;'";
        } else {
            $style = "";
        }

        echo "<tr $style>";
      
        echo "<td style='padding: 8px;'>$taskname</td>";
        echo "<td style='padding: 8px;'>$date</td>";
        echo "<td style='padding: 8px;'>$taskdescription</td>";
        echo "<td style='padding:8px;'><button type='button' style='font-size: 12px; padding: 8px 11px; border-radius: 4px; background-color: #4caf50; color: white; transition: all 0.2s; :hover { transform: scale(1.1); box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }' onclick='editTask($id)'>Edit</button></td>";
        echo "<td style='padding:8px;'><button type='button' style='font-size: 12px; padding: 8px 11px; border-radius: 4px; background-color: #4caf50; color: white; transition: all 0.2s; :hover { transform: scale(1.1); box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); }' onclick='deleteTask($id)'>Delete</button></td>";

        echo "</tr>";

         $i++;
    }
} else {
    echo "<tr>";
    echo "<td colspan='4' style='padding:8px;>No data found</td>";
    echo "</tr>";
  }

mysqli_close($conn);
        ?>

</body>
<script src="index.js"></script>

</html>