<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

$DATABASE_HOST = 'mysql1.cs.clemson.edu';
$DATABASE_USER = 'MTbDtbs_ks12';
$DATABASE_PASS = 'Htrox123!';
$DATABASE_NAME = 'MeTubeDatabase_j1it';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Upload</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>MeTube</h1>
				<label for="Search">
				</label>
				<input type="text" name="search" placeholder="Search" id="search" required>
                <a href="home.php">Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<?php
						//grabs profile picture
						$TABLE_NAME = 'ACCOUNT';

						$result = $con->query("SELECT * FROM $TABLE_NAME WHERE `AccountID` ='{$_SESSION['AccountID']}' ");
						while( $data = $result->fetch_assoc() ){
							//display image
							echo "<img src='{$data['ProfilePicturePath']}' >";  
						}
				?>
				<a href="upload.html"><i class="fas fa-upload-file"></i>Upload</a>
				<a href="messages.php"><i class="fas fa-messages-alt"></i>Messages</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
        <form method="post" enctype="multipart/form-data">
            <br>
            <table class="center">
            <tr><Td>Upload  Video</td></tr>
            <Tr><td><input type="file" name="profileDpAccount"/></td></tr>
            <tr><td><input type="submit" value="Upload Media" name="upd"/>
            <input type="submit" value="Display Media" name="disp"/>
        </td></tr>
    </table>
    </div>
	</body>
</html>