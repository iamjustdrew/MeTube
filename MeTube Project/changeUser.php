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
if ( !isset($_POST['NewUsername']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

$username = $_POST['NewUsername'];
//prepare the statement
$stmt = $con->prepare("SELECT username FROM ACCOUNT WHERE username=?");
$stmt->execute([$username]); 
$user = $stmt->fetch();
if ($user) {
    echo("username already exists");
    header('Location: profile.php');
    exit;
}
else{
    $sql = "UPDATE ACCOUNT SET username='$username' WHERE username='{$_SESSION['name']}'";
    if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $conn->error;
      }
    $_SESSION['name'] = $username;
    //exit($_SESSION['username']);
    header('Location: profile.php');
    exit;
}
?>
