<?php
include_once("conn.php");
//update like 1 button
if(isset($_POST['like_btn1']) && $_POST['like_btn1']=="like_btn1_upgrade"){
	$img_id=$_POST['img_id'];
	$q9="update image_like set like1=like1+1 where image_id=$img_id";
	$run9=mysqli_query($con,$q9);
	if($run9){
		echo"success";
	}else{
		echo"fail $q9";
	}
}
//downgrade like 1 button
if(isset($_POST['like_btn1']) && $_POST['like_btn1']=="like_btn1_downgrade"){
	$img_id=$_POST['img_id'];
	$q10="update image_like set like1=like1-1 where image_id=$img_id";
	$run10=mysqli_query($con,$q10);
	if($run10){
		echo"success";
	}else{
		echo"fail $q10";
	}
}

//update like 2 button
if(isset($_POST['like_btn2']) && $_POST['like_btn2']=="like_btn2_upgrade"){
	$img_id=$_POST['img_id'];
	$q11="update image_like set like2=like2+1 where image_id=$img_id";
	$run11=mysqli_query($con,$q11);
	if($run11){
		echo"success";
	}else{
		echo"fail $q11";
	}
}
//downgrade like 2 button
if(isset($_POST['like_btn2']) && $_POST['like_btn2']=="like_btn2_downgrade"){
	$img_id=$_POST['img_id'];
	$q12="update image_like set like2=like2-1 where image_id=$img_id";
	$run12=mysqli_query($con,$q12);
	if($run12){
		echo"success";
	}else{
		echo"fail $q12";
	}
}
//update unlike 1 button
if(isset($_POST['unlike_btn1']) && $_POST['unlike_btn1']=="unlike_btn1_upgrade"){
	$img_id=$_POST['img_id'];
	$q13="update image_like set unlike1=unlike1+1 where image_id=$img_id";
	$run13=mysqli_query($con,$q13);
	if($run13){
		echo"success";
	}else{
		echo"fail $q13";
	}
}
//downgrade unlike 1 button
if(isset($_POST['unlike_btn1']) && $_POST['unlike_btn1']=="unlike_btn1_downgrade"){
	$img_id=$_POST['img_id'];
	$q14="update image_like set unlike1=unlike1-1 where image_id=$img_id";
	$run14=mysqli_query($con,$q14);
	if($run14){
		echo"success";
	}else{
		echo"fail $q14";
	}
}
//update unlike 2 button
if(isset($_POST['unlike_btn2']) && $_POST['unlike_btn2']=="unlike_btn2_upgrade"){
	$img_id=$_POST['img_id'];
	$q15="update image_like set unlike2=unlike2+1 where image_id=$img_id";
	$run15=mysqli_query($con,$q15);
	if($run15){
		echo"success";
	}else{
		echo"fail $q15";
	}
}
//downgrade unlike 2 button
if(isset($_POST['unlike_btn2']) && $_POST['unlike_btn2']=="unlike_btn2_downgrade"){
	$img_id=$_POST['img_id'];
	$q16="update image_like set unlike2=unlike2-1 where image_id=$img_id";
	$run16=mysqli_query($con,$q16);
	if($run16){
		echo"success";
	}else{
		echo"fail $q16";
	}
}
?>