<?php
include_once("conn.php");
if(!isset($_GET['id'])){
	echo"<script> location.href='add.php'; </script>";
}
$q1="update visitor_counter set index_page=index_page+1";
$run1=mysqli_query($con,$q1);
$get_id=mysqli_real_escape_string($con,$_GET['id']);
$get_id=htmlentities($get_id);
$q5="select * from user where id={$get_id}";
$run5=mysqli_query($con,$q5);
$row5=mysqli_fetch_assoc($run5);
?>
<html>
<head>
<title>RAMSWAROOPians</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
<h1 class="text-center mt-2"><img width="150px" src="image/logo.png" class="img-fluid"> RAMSWAROOPians</h1>
<div class="text-center bg-white my-2 shadow rounded">
<div class="row">
<div class="col-md-12"><div class="text-success text-center d-none" id="copy_url">Link is Copied to Clipboard</div>
</div>
<div class="col-md-6">
<a href="add.php" class="p-2 text-primary d-block"><span class="blink"><i class="fas fa-arrow-right"></i></span> <b>Create your own photo challenge.</b></a>
</div>
<div class="col-md-6 text-primary p-2" data-clipboard-text="<?php echo$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" id="copy" data-clipboard-action="copy">
<i class="fas fa-share"></i> <b>Share link of this Challenge</b>
</div>
</div>
</div>
<div class="container mt-4 mb-4"><!-- container start -->
<h4 class="text-center"><?php echo$row5['user1']." VS ".$row5['user2']; ?></h4>
<div class="row"> <!-- row to show username start -->
<div class="col-6"><!-- col-6 start -->
<h3 class="text-center h3"><?php echo$row5['user1'];?></h3>
</div>
<div class="col-6"><!-- col-6 start -->
<h3 class="text-center h3"><?php echo$row5['user2'];?></h3>
</div>
</div><!-- row to show username end -->
<div class="row"><!-- row to show user image start -->
<div class="col-6 text-center rem_pad">
<image src="image/<?php echo$row5['image1'];?>" class="img-fluid shadow rounded" id="image1">
</div>
<div class="col-6 text-center rem_pad">
<image src="image/<?php echo$row5['image2'];?>" class="img-fluid shadow rounded" id="image2">
</div>
</div><!-- row to show user image end -->
<div class="row mt-3"><!-- row to show like count -->
<div class="col-3 text-center" id="show_like1_count"></div>
<div class="col-3 text-center" id="show_unlike1_count"></div>
<div class="col-3 text-center" id="show_like2_count"></div>
<div class="col-3 text-center" id="show_unlike2_count"></div>
</div><!-- row to show like count end -->
<div class="row"><!-- row to show like unlike end -->
<div class="col-3 text-center rem_pad">
<button class="btn btn-light shadow btn-block" id="like_btn1"> Hot <i class="fas fa-thumbs-up fa-2x" id="thumb_up1"></i></button>
<input type="hidden" value="like1_btn_disactive" id="hidden_like1">
</div>
<div class="col-3 text-center rem_pad">
<button class="btn btn-light shadow btn-block" id="unlike_btn1"> Not <i class="fas fa-thumbs-down fa-2x" id="thumb_down1"></i></button>
<input type="hidden" value="unlike1_btn_disactive" id="hidden_unlike1">
</div>
<div class="col-3 text-center rem_pad">
<button class="btn btn-light shadow btn-block" id="like_btn2"> Hot <i class="fas fa-thumbs-up fa-2x" id="thumb_up2"></i></button>
<input type="hidden" value="like2_btn_disactive" id="hidden_like2">
</div>
<div class="col-3 text-center rem_pad">
<button class="btn btn-light shadow btn-block" id="unlike_btn2"> Not <i class="fas fa-thumbs-down fa-2x"  id="thumb_down2"></i></button>
<input type="hidden" value="unlike2_btn_disactive" id="hidden_unlike2">
</div>
</div><!-- row to show like unlike button end -->
<form id="cmnt_form">
<div class="row">
<div class="col-12 d-none" id="show_msg1">
<div class="alert alert-success mb-0 mt-2 w-100">You commented</div>
</div>
<div class="col-12 d-none" id="show_msg2">
<div class="alert alert-danger mb-0 mt-2 w-100">Please write your comment.</div>
</div>
</div>
<input type="hidden" value="enter_comment" name="check_cmnt">
<input type="hidden" value="<?php echo$get_id; ?>" name="cmnt_img_id">
<div class="row mt-3"><!-- row enter comment start -->
<div class="col-3 rem_pad">
<input type="text" class="form-control shadow" placeholder="Your name (optional)" name="cmnt_user" id="cmnt_user_name">
</div>
<div class="col-6 rem_pad">
<input type="text" class="form-control shadow" placeholder="Comment" name="comment" id="comment">
</div>
<div class="col-3 rem_pad">
<input type="submit" value="Comment" class="btn btn-primary btn-block shadow" id="comment_btn">
</div>
</div><!-- row enter comment  end -->
</form>
<div class="row mt-4 shadow rounded" id="show_comment"><!-- row show comment  end -->
</div><!-- row show comment  end -->
</div><!-- container end -->
<script src="js/jquery.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/clipboard.min.js"></script>
<script>
$(document).ready(function(){
	new ClipboardJS('#copy');
//counting like1 
function count_like1(){
	$.ajax({
		url:"server6.php",
		type:"post",
		data:"count_like1=countlike1&img_id=<?php echo$get_id ?>",
		success:function(getdata13){
			$("#show_like1_count").text(getdata13);
		}
	});
}
//counting like2 
function count_like2(){
	$.ajax({
		url:"server6.php",
		type:"post",
		data:"count_like2=countlike2&img_id=<?php echo$get_id ?>",
		success:function(getdata14){
			$("#show_like2_count").text(getdata14);
		}
	});
}
//counting unlike1 
function count_unlike1(){
	$.ajax({
		url:"server6.php",
		type:"post",
		data:"count_unlike1=countunlike1&img_id=<?php echo$get_id ?>",
		success:function(getdata15){
			$("#show_unlike1_count").text(getdata15);
		}
	});
}
//counting unlike1 
function count_unlike2(){
	$.ajax({
		url:"server6.php",
		type:"post",
		data:"count_unlike2=countunlike2&img_id=<?php echo$get_id ?>",
		success:function(getdata16){
			$("#show_unlike2_count").text(getdata16);
		}
	});
}
count_like1();
count_unlike1();
count_like2();
count_unlike2();
//like 1 button
$("#like_btn1").click(function(){
	like1_val=$("#hidden_like1").val();
	if(like1_val=="like1_btn_disactive"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"like_btn1=like_btn1_upgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata6){
			 if(getdata6="success"){
				 $("#thumb_up1").addClass("text-primary");
				 $("#hidden_like1").val("like1_btn_active");
				 $("#unlike_btn1").attr("disabled",true);
				 count_like1();
			 }
		 }
		});
	}
	if(like1_val=="like1_btn_active"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"like_btn1=like_btn1_downgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata7){
			 if(getdata7="success"){
				 $("#thumb_up1").removeClass("text-primary");
				 $("#hidden_like1").val("like1_btn_disactive");
				 $("#unlike_btn1").attr("disabled",false);
				 count_like1();
			 }
		 }
		});
	}
});
//like 2 button
$("#like_btn2").click(function(){
	like2_val=$("#hidden_like2").val();
	if(like2_val=="like2_btn_disactive"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"like_btn2=like_btn2_upgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata8){
			 if(getdata8="success"){
				 $("#thumb_up2").addClass("text-primary");
				 $("#hidden_like2").val("like2_btn_active");
				 $("#unlike_btn2").attr("disabled",true);
				 count_like2();
			 }
		 }
		});
	}
	if(like2_val=="like2_btn_active"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"like_btn2=like_btn2_downgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata9){
			 if(getdata9="success"){
				 $("#thumb_up2").removeClass("text-primary");
				 $("#hidden_like2").val("like2_btn_disactive");
				 $("#unlike_btn2").attr("disabled",false);
				 count_like2();
			 }
		 }
		});
	}
});
//unlike 1 button
$("#unlike_btn1").click(function(){
	unlike1_val=$("#hidden_unlike1").val();
	if(unlike1_val=="unlike1_btn_disactive"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"unlike_btn1=unlike_btn1_upgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata10){
			 if(getdata10="success"){
				 $("#thumb_down1").addClass("text-primary");
				 $("#hidden_unlike1").val("unlike1_btn_active");
				 $("#like_btn1").attr("disabled",true);
				 count_unlike1();
			 }
		 }
		});
	}
	if(unlike1_val=="unlike1_btn_active"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"unlike_btn1=unlike_btn1_downgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata11){
			 if(getdata11="success"){
				 $("#thumb_down1").removeClass("text-primary");
				 $("#hidden_unlike1").val("unlike1_btn_disactive");
				 $("#like_btn1").attr("disabled",false);
				 count_unlike1();
			 }
		 }
		});
	}
});
//unlike 2 button
$("#unlike_btn2").click(function(){
	unlike2_val=$("#hidden_unlike2").val();
	if(unlike2_val=="unlike2_btn_disactive"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"unlike_btn2=unlike_btn2_upgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata12){
			 if(getdata12="success"){
				 $("#thumb_down2").addClass("text-primary");
				 $("#hidden_unlike2").val("unlike2_btn_active");
				 $("#like_btn2").attr("disabled",true);
				 count_unlike2();
			 }
		 }
		});
	}
	if(unlike2_val=="unlike2_btn_active"){
		$.ajax({
		 url:"server5.php",
		 type:"post",
		 data:"unlike_btn2=unlike_btn2_downgrade&img_id=<?php echo$get_id ?>",
		 success:function(getdata12){
			 if(getdata12="success"){
				 $("#thumb_down2").removeClass("text-primary");
				 $("#hidden_unlike2").val("unlike2_btn_disactive");
				 $("#like_btn2").attr("disabled",false);
				 count_unlike2();
			 }
		 }
		});
	}
});
//loading all comment for the above image
 function cmnt_load(){
	 $.ajax({
		 url:"server4.php",
		 type:"post",
		 data:"load_comment=load_comment&img_id=<?php echo$get_id ?>",
		 success:function(getdata5){
			 $("#show_comment").html(getdata5);
		 }
	 });
 }
cmnt_load();
//inserting comment into table
$("#cmnt_form").submit(function(e){
	 e.preventDefault();
	 cmnt=$("#comment").val();
	 cmnt=cmnt.trim();
	 if(cmnt!=''){
		$.ajax({
		 url:"server4.php",
		 type:"post",
		 data:$("#cmnt_form").serialize(),
		 success:function(getdata4){
			 if(getdata4=='success'){
				 $("#cmnt_form").trigger("reset");
				 $("#show_msg1").removeClass("d-none");
				 setTimeout(function(){
					 $("#show_msg1").addClass("d-none");}, 4000);
					 cmnt_load();
			 }
			}
		}); 
	 }else{
		 $("#show_msg2").removeClass("d-none");
		 setTimeout(function(){
		 $("#show_msg2").addClass("d-none");}, 4000);
	 }
});
	$("#copy").click(function(){
		$("#copy_url").removeClass("d-none");
		 setTimeout(function(){
		 $("#copy_url").addClass("d-none");}, 4000);
	});
});
</script>
</div>
</body>
</html>