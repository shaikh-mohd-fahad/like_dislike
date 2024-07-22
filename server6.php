<?php
include_once("conn.php");
//total like1 count
if(isset($_POST['count_like1']) && $_POST['count_like1']=="countlike1"){
	$img_id=$_POST['img_id'];
	$q17="select * from image_like where image_id=$img_id";
	$run17=mysqli_query($con,$q17);
	$row17=mysqli_fetch_array($run17);
	echo$row17['like1'];
}
//total like2 count
if(isset($_POST['count_like2']) && $_POST['count_like2']=="countlike2"){
	$img_id=$_POST['img_id'];
	$q18="select * from image_like where image_id=$img_id";
	$run18=mysqli_query($con,$q18);
	$row18=mysqli_fetch_array($run18);
	echo$row18['like2'];
}
//total unlike1 count
if(isset($_POST['count_unlike1']) && $_POST['count_unlike1']=="countunlike1"){
	$img_id=$_POST['img_id'];
	$q19="select * from image_like where image_id=$img_id";
	$run19=mysqli_query($con,$q19);
	$row19=mysqli_fetch_array($run19);
	echo$row19['unlike1'];
}
//total unlike2 count
if(isset($_POST['count_unlike2']) && $_POST['count_unlike2']=="countunlike2"){
	$img_id=$_POST['img_id'];
	$q20="select * from image_like where image_id=$img_id";
	$run20=mysqli_query($con,$q20);
	$row20=mysqli_fetch_array($run20);
	echo$row20['unlike2'];
}
?>