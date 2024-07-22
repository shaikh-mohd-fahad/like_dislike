<?php
if(session_id()==''){
	session_start();
}
include_once("conn.php");
//uploade image1 of add.php page using ajax
if(isset($_FILES['upload_img1']['name']) && $_FILES['upload_img1']['name']!=""){
	$rfilename=$_FILES['upload_img1']['name'];
	$size=$_FILES['upload_img1']['size'];
	$arr2=explode(".",$rfilename);// real filename
	$extension=end($arr2);//to get extension of arr2 array
	$arr=array("png","jpeg","jpg");
	if(in_array($extension,$arr)){//validating image
		//reducing image size
		if($size<=2097152){
			if($extension=='jpg'){
				$fake_filename=imagecreatefromjpeg($_FILES['upload_img1']['tmp_name']);
				$rfilename="Blogiez.com_".rand(1111,9999)."_".$rfilename;
				if($size>=102400){
					imagejpeg($fake_filename,"image/".$rfilename,50);
				}else{
					imagejpeg($fake_filename,"image/".$rfilename,100);
				}
			}else 
			if($extension=='png'){
				$fake_filename=imagecreatefrompng($_FILES['upload_img1']['tmp_name']);
				$rfilename="Blogiez.com_".rand(1111,9999)."_".$rfilename;
				if($size>=102400){
					imagejpeg($fake_filename,"image/".$rfilename,50);
				}else{
					imagejpeg($fake_filename,"image/".$rfilename,100);
				}
			}
			$q3="UPDATE `user` SET `image1` ='$rfilename' WHERE `user`.`id` ={$_SESSION['user_id']} ";
			$run3=mysqli_query($con,$q3);
			echo"image/$rfilename";//sendig src path to img tag
		}else{
			echo"error2";
			$q3="UPDATE `user` SET `image1` ='' WHERE `user`.`id` ={$_SESSION['user_id']} ";
			$run3=mysqli_query($con,$q3);
		}
	}else{
		echo"error1";
		$q3="UPDATE `user` SET `image1` ='' WHERE `user`.`id` ={$_SESSION['user_id']} ";
			$run3=mysqli_query($con,$q3);
	}
}
?>