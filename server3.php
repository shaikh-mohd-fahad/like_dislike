<?php
if(session_id()==''){
	session_start();
}
include_once("conn.php");
$username1="Unknown";
$username2="Unknown";
if(isset($_POST['username1']) && $_POST['username1']!=""){
$username1=$_POST['username1'];
$username1=mysqli_real_escape_string($con,$username1);
$username1=htmlentities($username1);
}
if(isset($_POST['username2']) && $_POST['username2']!=""){
$username2=$_POST['username2'];
$username2=mysqli_real_escape_string($con,$username2);
$username2=htmlentities($username2);
}
$q4="update user set user1='$username1', user2='$username2' where id={$_SESSION['user_id']}";
if(mysqli_query($con,$q4)){
	$q8="insert into image_like(image_id) value({$_SESSION['user_id']})";
	$run8=mysqli_query($con,$q8);
	echo"success";
}
?>