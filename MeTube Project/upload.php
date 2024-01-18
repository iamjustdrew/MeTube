<?php
error_reporting(1);
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
mysql_select_db("MEDIA",$con);
extract($_POST);
$target_dir = "uploads/";
$fileName = basename($_FILES["profileDpAccount"]["name"]);
$target_file = $target_dir . $fileName;

if($upd)
{
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "mp4" && $imageFileType != "avi" && $imageFileType != "mov" && $imageFileType != "3gp" && $imageFileType != "mpeg")
{
    echo "File Format Not Suppoted";
} 
else
{
$video_path=$_FILES['profileDpAccount']['name'];
move_uploaded_file($_FILES["profileDpAccount"]["tmp_name"],$target_file);
$insert = $con->mysql_query("INSERT INTO MEDIA (type, name, path, lastaccess) values('1', '$fileName','$video_path', NOW())");
if($insert)
    echo "succesful";
else
    echo "fail";
}
}
//display all uploaded video

if($disp)
{
    $query=mysql_query("SELECT * FROM MEDIA");
	while($all_video=mysql_fetch_array($query))
{
?>
	 <video width="300" height="200" controls>
	<source src="test_uploads/<?php echo $all_video['video_name']; ?>" type="video/mp4">
	</video> 
	
<?php } } ?>