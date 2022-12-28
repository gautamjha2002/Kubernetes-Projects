<?php
// Connect to the database server
$host = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$port = 3306;
$dbname = "tododb";
$tablename = "tasks";



$conn = mysqli_connect($host, $username, $password, $dbname,$port);

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
    header("Location: tasks.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

?>