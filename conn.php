<?php
if(session_id()==''){
	session_start();
}
$con=mysqli_connect("localhost","root",'',"bncet");
?>