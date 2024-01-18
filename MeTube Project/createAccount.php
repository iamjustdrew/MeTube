<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'mysql1.cs.clemson.edu';
$DATABASE_USER = 'MTbDtbs_ks12';
$DATABASE_PASS = 'Htrox123!';
$DATABASE_NAME = 'MeTubeDatabase_j1it';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password'], $_POST['email']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill all of the fields!');
}
//get username from form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
//prepare the statement
$stmt = $con->prepare("SELECT username FROM ACCOUNT WHERE username=?");
//execute the statement
$stmt->execute([$username]); 
//fetch result
$stmt->store_result();
$user = $stmt->fetch();
if ($user) {
    exit("username already exists");}
     else {
    $sql = "INSERT INTO ACCOUNT (email, username, password, type) VALUES ('$email', '$username', '$password', '1')";
    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $con->error;
      }
    $AccountID = "SELECT AccountID FROM ACCOUNT WHERE username='$username'";

if ($_POST['password'] === $password) {
    // Verification success! User has logged-in!
    // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['AccountID'] = $AccountID;
    header('Location: home.php');
} 
$stmt->close();

} 

?>
