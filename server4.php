<?php
include_once("conn.php");
$cmnt_user="Unknown";
date_default_timezone_set("Asia/Kolkata");
$dt=date('h:ia j/m/Y');
// inserting comment into table
if(isset($_POST['check_cmnt']) && $_POST['check_cmnt']=="enter_comment"){
	$cmnt_img_id=$_POST['cmnt_img_id'];
	if($_POST['cmnt_user']!=''){
		$cmnt_user=mysqli_real_escape_string($con,$_POST['cmnt_user']);
		$cmnt_user=htmlentities($cmnt_user);
	}
	$comment=mysqli_real_escape_string($con,$_POST['comment']);
	$comment=htmlentities($comment);
	$q6="insert into comment(user,comment,image_id,time_date) values('$cmnt_user','$comment',$cmnt_img_id,'$dt')";
	$run6=mysqli_query($con,$q6);
	if($run6){
		echo"success";
	}else{
		echo"fail";
	}
}
//loading all comment on the given id of image
if(isset($_POST['load_comment']) && $_POST['load_comment']=="load_comment" && isset($_POST['img_id'])){
	$all_comment="";
	$img_id=$_POST['img_id'];
	$q7="select * from comment where image_id=$img_id order by id desc";
	$run7=mysqli_query($con,$q7);
	if(mysqli_num_rows($run7)>0){
		while($row7=mysqli_fetch_array($run7)){
		$all_comment.="
		<div class='col-3 border-bottom py-1'>".$row7['user']."</div>
<div class='col-6 border-bottom py-1'>".$row7['comment']."</div>
<div class='col-3 border-bottom py-1 text-center'><small>".$row7['time_date']."</small></div>";
		}
		echo$all_comment;
	}
}
?>