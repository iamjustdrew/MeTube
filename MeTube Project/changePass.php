<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'mysql1.cs.clemson.edu';
$DATABASE_USER = 'MTbDtbs_ks12';
$DATABASE_PASS = 'Htrox123!';
$DATABASE_NAME = 'MeTubeDatabase_j1it';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_error() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if ( !isset($_POST['NewPassword']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$password = $_POST['NewPassword'];
//prepare the statement
$sql = "UPDATE ACCOUNT SET password='$password' WHERE username='{$_SESSION['name']}'";
    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    //exit($_SESSION['username']);
    header('Location: profile.php');
    exit;
?>