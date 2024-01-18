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
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM ACCOUNT WHERE AccountID = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['AccountID']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
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
				<a href="uploadPage.php"><i class="fas fa-upload-file"></i>Upload</a>
				<a href="messages.php"><i class="fas fa-messages-alt"></i>Messages</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
						<td><a href="changeUser.html"><i class="fas fa-change-user"></i>Change Username</a></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
						<td><a href="changePass.html"><i class="fas fa-change-pass"></i>Change Password</a></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
						<td><a href="changeEmail.html"><i class="fas fa-change-email"></i>Change Email</a></td>
					</tr>
					<tr>
						<td>Profile Picture:</td>
						<td><a href="changePP.html"><i class="fas fa-change-PP"></i>Profile Picture</a></td>
					</tr>
				</table>
			</div>
				<p>Your Uploads</p>
				<?php
					$TABLE_NAME = 'MEDIA';
		
					$result = $con->query("SELECT * FROM $TABLE_NAME WHERE `AccountID` ='{$_SESSION['AccountID']}' ");
		
					while( $data = $result->fetch_assoc() ){

						//display media name
						echo " <h2>{$data['name']}</h2>";
						
						
						//display image
						if($data['type'] == "image")
						{
							echo "<img src='{$data['path']}' >";  
				
							//download button      \/
							//echo '<a href= '$data['path']' download=("image.jpg")> Download Image File </image>";
						}
				
						//music player
						elseif($data['type'] == "audio")
						{
							echo '<audio src="uploads\Allison.mp3" controls></audio>';
							//download button       \/
							//echo '<a href= "uploads\Allison.mp3" download=("sound.mp3")> Download Audio File </audio>';
						}
						elseif($data['type'] == "video")
						{
							echo '<video controls> <source src= "uploads/present.mp4"/> </video>';
							
							//download button      \/
							//echo '<a href= "uploads/present.mp4" download=("video.mp4")> Download Video File </video>';
						}
					}
				?>
			</div>
			<div>
		</div>
	</body>
</html>