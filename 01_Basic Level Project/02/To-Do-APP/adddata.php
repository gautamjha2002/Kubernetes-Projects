<?php
// Connect to the database server
$host = "localhost:8082";
$username = "root";
$password = "root";
$dbname = 'tododb';
$tablename = 'tasks';


$conn = mysqli_connect($host, $username, $password, $dbname);

// Get the form data
$taskname = $_POST['taskname'];
$date = $_POST['date'];
$description = $_POST['taskdescription'];

// Sanitize the input to prevent SQL injection attacks
$taskname = mysqli_real_escape_string($conn, $taskname);
$date = mysqli_real_escape_string($conn, $date);
$description = mysqli_real_escape_string($conn, $description);

// Create the INSERT statement
$sql = "INSERT INTO $tablename (taskname, date, taskdescription) VALUES ('$taskname', '$date', '$description')";

// Execute the INSERT statement
if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>