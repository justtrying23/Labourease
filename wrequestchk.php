<?php
session_start();
include 'connection.php';

if(!isset($_SESSION['Wname']) || !isset($_SESSION['Wemail']) || empty($_SESSION['Wname']) || empty($_SESSION['Wemail'])){
	header("location: Wcreate.php");
  exit;
}
$email=$_SESSION['Wemail'];
  $request="SELECT req.status, cust.phone , cust.Email, cust.Name from request as req right join customer as cust ON req.sender=cust.Email where req.reciver = '$email'AND req.status = 'accepted' ";
  $exec=mysqli_query($conn,$request);
  if (!$exec) {
    die("Error executing query: " . mysqli_error($conn));
}
if(mysqli_num_rows($exec)>0){
    header("location: wjob.php");   
}else{
    header("location: WNOjobs.php");
}
?>