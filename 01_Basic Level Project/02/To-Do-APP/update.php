<?php

// Connect to the database server
$host = "localhost:8082";
$username = "root";
$password = "root";
$dbname = "tododb";
$tablename = 'tasks';

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$id = $_POST["id"];
$taskname = $_POST["taskname"];
$date = $_POST["date"];
$taskdescription = $_POST["taskdescription"];

// Update the task in the database
$sql = "UPDATE tasks SET taskname = '$taskname', date = '$date', taskdescription = '$taskdescription' WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    // Redirect to the index page
    header("Location: index.php");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
