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

// Get the task ID from the query parameter
$id = $_GET['id'];

// Sanitize the input to prevent SQL injection attacks
$id = mysqli_real_escape_string($conn, $id);

// Create the DELETE statement
$sql = "DELETE FROM tasks WHERE id = $id";

// Execute the DELETE statement
if (mysqli_query($conn, $sql)) {
    header("Location: tasks.php");
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
