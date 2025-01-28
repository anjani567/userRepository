<?php

//For login
session_start(); // Start the session

// include('auth.php');  
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'crud';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$username = $_POST['user'];  
$password = $_POST['pass'];  
          
//to prevent from mysqli injection  

$username = stripcslashes($username);  
$password = stripcslashes($password);  
$username = mysqli_real_escape_string($con, $username);  
$password = mysqli_real_escape_string($con, $password);

$sql = "select * from admin where username = '$username' and password = '$password'";  
$result = mysqli_query($con, $sql);  
  // $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
  // $count = mysqli_num_rows($result);  
  // echo($result)
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_array($result)){
        print_r($row);

        $_SESSION['user_name'] = $username;

        // echo "<h1><center><alert> Login successful </center><alert/></h1>";  
        header('location:adminDashboard.php');
        
      }
    }else{  
    echo "<h1> Login failed. Invalid username or password.</h1>";  
  } 



?>