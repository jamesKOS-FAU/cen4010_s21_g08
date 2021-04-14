<?php include 'config.php';
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: index.php");exit;
	}
?>

<?php
error_reporting(E_ALL & ~E_NOTICE);
$title=addslashes($_POST['Title']);
if(strlen($title) == 0) {
	echo ('Unable to upload post. Check that the title is not blank and the upload is an image of size smaller than 8 megabytes.');exit;
}
$postContent=addslashes($_POST['Content']);
$postContent = (strlen($postContent) == 0) ? 'NULL' : "'$postContent'";
$image = addslashes(file_get_contents($_FILES['Image']['tmp_name']));
$image = ($image == '') ? 'NULL' : "'$image'";
$ftype = addslashes($_FILES['Image']['type']);
$ftype = ($ftype == '') ? 'NULL' : "'$ftype'";
echo($ftype . "\n");
echo(substr($ftype,1,5));
if (($ftype != 'NULL') && (substr($ftype,1,5) != 'image')) {
	echo('The image provided was not recognized. PostHut only supports image uploads at this time.');exit;
}

$id = $_SESSION['id'];

mysqli_query($link,"INSERT INTO Posts (Title,Content,Image,Nices,Filetype,Creator) VALUES ('$title',$postContent,$image,0,$ftype,$id)");
				
	if(mysqli_affected_rows($link) > 0){
	echo '<meta http-equiv="refresh" content="0; URL=home.php" />';
} else {
	echo "Fail<br>";
	echo mysqli_error ($link);
}