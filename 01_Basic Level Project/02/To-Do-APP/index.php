<?php

// Connect to the database server
$host = getenv("DB_HOST");
$username = getenv("DB_USER");
$password = getenv("DB_PASSWORD");
$port = 3306;
$dbname = "tododb";
$tablename = "tasks";



$conn = mysqli_connect($host, $username, $password,"",$port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the database exists
$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    // check if table exist or not
    $conn = mysqli_connect($host, $username, $password, $dbname);
    // Check if the table exists
    $sql = "SHOW TABLES LIKE '$tablename'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        header("Location: tasks.php");
    } else {
        

        // Create the table
        $sql = "CREATE TABLE tasks (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            taskname VARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            taskdescription TEXT NOT NULL
        )";
  
            if (mysqli_query($conn, $sql)) {



                if(isset($_POST['taskname'])){

                    $taskname = $_POST['taskname'];
                
                }else{
                
                    // $taskname = "Example Task 1";
                    header("Location: tasks.php");
                    
                    
                
                }

                if(isset($_POST['date'])){

                    $date = $_POST['date'];
                
                }else{
                
                    // $date = "$curdate";
                    header("Location: tasks.php");
                
                }

                if(isset($_POST['taskdescription'])){

                    $taskdescription = $_POST['taskdescription'];
                
                }else{
                
                    // $taskdescription = "Example Description";
                    header("Location: tasks.php");
                
                }



                    // Get the data from the form
                    // $taskname = $_POST['taskname'];
                    // $date = $_POST['date'];
                    // $taskdescription = $_POST['taskdescription'];

                    // Insert the data into the database
                    $sql = "INSERT INTO $tablename (taskname, date, taskdescription) VALUES ('$taskname', '$date', '$taskdescription')";

                    if (mysqli_query($conn, $sql)) {
                        header("Location: tasks.php");
                    } else {
                        echo "Error inserting data: " . mysqli_error($conn);
                    }

            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }
    }
} else {
  // create database 
  // Create the database
    $sql = "CREATE DATABASE $dbname";

    if (mysqli_query($conn, $sql)) {
    
        // Create table 

        
        // Create the table
        $sql = "CREATE TABLE tasks (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            taskname VARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            taskdescription TEXT NOT NULL
        )";
$conn = mysqli_connect($host, $username, $password, $dbname);
            if (mysqli_query($conn, $sql)) {



                if(isset($_POST['taskname'])){

                    $taskname = $_POST['taskname'];
                
                }else{
                
                    // $taskname = "Example Task 1";
                    header("Location: tasks.php");
                
                }

                if(isset($_POST['date'])){

                    $date = $_POST['date'];
                
                }else{
                
                    // $date = "$curdate";
                    header("Location: tasks.php");
                
                }

                if(isset($_POST['taskdescription'])){

                    $taskdescription = $_POST['taskdescription'];
                
                }else{
                
                    // $taskdescription = "Example Description";
                    header("Location: tasks.php");
                
                }




                     // Get the data from the form
                    //  $taskname = $_POST['taskname'];
                    //  $date = $_POST['date'];
                    //  $taskdescription = $_POST['taskdescription'];

                    // Insert the data into the database
                    $sql = "INSERT INTO tasks (taskname, date, taskdescription) VALUES ('$taskname', '$date', '$taskdescription')";

                    if (mysqli_query($conn, $sql)) {
                        header("Location: tasks.php");
                    } else {
                        echo "Error inserting data: " . mysqli_error($conn);
                    }


            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }




    } else {
    echo "Error creating database: " . mysqli_error($conn);
    }  
}







mysqli_close($conn);

?>
