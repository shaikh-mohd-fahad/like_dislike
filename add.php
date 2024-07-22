<?php
if(session_id()==''){
	session_start();
}
date_default_timezone_set("Asia/Kolkata");
$dt=date('h:ia j/m/Y');
include_once("conn.php");
$q1="update visitor_counter set add_page=add_page+1";
$run1=mysqli_query($con,$q1);
$q2="INSERT INTO `user` (`id`, `user1`, `user2`, `image1`, `image2`, `time`) VALUES (NULL, '', '', '', '','$dt')";
$run2=mysqli_query($con,$q2);
$last_id=mysqli_insert_id($con);
$_SESSION['user_id']=$last_id;
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
<h2 id="h2" class="text-center shadow py-1 rounded text-primary">Add 2 Photos to compare it.</h2>
<div class="container"> <!-- container start -->
<form id="form_img">
<div class="row"><!-- row to get username start -->
<div class="col-6 my-3"><!-- col-6 start -->
<input type="text" name="username1" id="username1" placeholder="Enter First User name (optional)" class="form-control">
</div><!-- col-6 end -->

<div class="col-6 my-3"><!-- col-6 start -->
<input type="text" name="username2" id="username2" placeholder="Enter Second User name (optional)" class="form-control">
</div><!-- col-6 end -->
</div><!-- row to get username end -->
<div class="row"><!-- row to show error start -->
<div class="col-6 my-3 d-none" id="showerror1"></div>
<div class="col-6 my-3 d-none" id="showerror2"></div>
</div><!-- row to show end -->
<div class="row"><!-- row to image and spinner start -->
<div class="col-6"><!-- col-6 start -->
<div class="text-center" id="loader1">
<span id="loader_spin1" class="text-primary"><i class="fas fa-spinner fa-spin fa-2x"></i> <font size="6">Uploading...</font></span>
<img src="image/not_available.png" id="img1" class="img-fluid shadow rounded">
</div>
<label class="btn btn-light my-3 btn-block border shadow" id="upload_img1_btn">Upload Image 1
<input type="file" id="upload_img1" name="upload_img1" class="d-none">
</label>
</div><!-- col-6 end -->
<div class="col-6"><!-- col-6 start -->
<div class="text-center" id="loader2">
<span id="loader_spin2" class="text-primary"><i class="fas fa-spinner fa-spin fa-2x"></i> <font size="6">Uploading...</font></span>
<img src="image/not_available.png" id="img2" class="img-fluid shadow rounded">
</div>
<label class="btn btn-primary my-3 btn-block shadow" id="upload_img2_btn">Upload Image 2
<input type="file" id="upload_img2" name="upload_img2" class="d-none">
</label>
</div><!-- col-6 end -->
</div><!-- row to show image and spinner end -->
<div class="row"><!-- row to submit form start -->
<input type="submit" name="submitImage" value="Submit" class="btn btn-block shadow border border-dark my-3">
</div><!-- row to submit form end -->
</form>
</div><!-- container end -->
</div>
<script src="js/jquery.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/all.min.js"></script>
<script src="js/clipboard.min.js"></script>
<script>
$(document).ready(function(){
	$("#loader_spin1").hide();
	$("#loader_spin2").hide();
	//use to send data to server
	$("#form_img").submit(function(e){
		e.preventDefault();
		image1=$("#upload_img1").val();
		image2=$("#upload_img2").val();
		if(image1.length==0){
			$("#showerror1").removeClass("d-none").html("<div class='alert alert-danger'>**Upload Image 1</div>");
		}
		if(image2.length==0){
			$("#showerror2").removeClass("d-none").html("<div class='alert alert-danger'>**Upload Image 2</div>");
		}
		if(image1.length>0 && image2.length>0){
			username1=$("#username1").val();
			z=$("#form_img").serialize();
			$.ajax({
				url:"server3.php",
				type:"POST",
				data:z,
				success: function(getdata3){
					if(getdata3=='success'){
						location.href="index.php?id=<?php echo$_SESSION['user_id']; ?>";
					}
				}
			});
		}
		});
	//uploading image 1 to server
	$("#upload_img1").change(function(){
	var a= new FormData(form_img);
	$.ajax({
		url:"server.php",
		type:"POST",
		data:a,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$("#img1").hide();
			$("#loader_spin1").show();
		},
		success:function(getdata){
			if(getdata=='error1'){
				$("#showerror1").removeClass("d-none").html("<div class='alert alert-danger'>File extension of image 1 is not valid.</div>");
				image1=$("#upload_img1").val("");
				$("#loader_spin1").hide();
				$("#img1").attr("src","image/not_available.png").show();
			}else
			if(getdata=='error2'){
				$("#showerror1").removeClass("d-none").html("<div class='alert alert-danger'>File size must be less than 2mb.</div>");
				image1=$("#upload_img1").val("");
				$("#loader_spin1").hide();
				$("#img1").attr("src","image/not_available.png").show();
			}
			else{
				$("#loader_spin1").hide();
				$("#img1").show();
				$("#img1").attr("src",getdata);
				$("#showerror1").addClass("d-block").html("<div class='alert alert-success'>Image 1 is uploaded.</div>");
			}
		}
	});
	});
	//uploading image 2 to server
	$("#upload_img2").change(function(){
	var b= new FormData(form_img);
	$.ajax({
		url:"server2.php",
		type:"POST",
		data:b,
		contentType: false,
		processData: false,
		beforeSend:function(){
			$("#img2").hide();
			$("#loader_spin2").show();
		},
		success:function(getdata2){
			if(getdata2=='error1'){
				$("#showerror2").removeClass("d-none").html("<div class='alert alert-danger'>File extension of image 2 is not valid.</div>");
				image2=$("#upload_img2").val("");
				$("#loader_spin2").hide();
				$("#img2").attr("src","image/not_available.png").show();
			}else
			if(getdata2=='error2'){
				$("#showerror2").removeClass("d-none").html("<div class='alert alert-danger'>File size must be less than 2mb.</div>");
				image2=$("#upload_img2").val("");
				$("#loader_spin2").hide();
				$("#img2").attr("src","image/not_available.png").show();
			}
			else{
				$("#loader_spin2").hide();
				$("#img2").show();
				$("#img2").attr("src",getdata2);
				$("#showerror2").addClass("d-block").html("<div class='alert alert-success'>Image 2 is uploaded.</div>");
			}
		}
	});
	});
});
</script>
</body>
</html>