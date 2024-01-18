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
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Media</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	</head>
	<body>
		<div class="media">
			<?php
				$TABLE_NAME = 'MEDIA';
					
				$result = $con->query("SELECT * FROM $TABLE_NAME");
				
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
		<div class="comments">
			<form action="" method="post">
				<input type="text" name="comment" placeholder="Add a comment..." id="comment" required>
			</form>
		</div>
	</body>
</html>