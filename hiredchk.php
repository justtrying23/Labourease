<?php
session_start();
include 'connection.php';

if(!isset($_SESSION['name']) || !isset($_SESSION['email']) || empty($_SESSION['name']) || empty($_SESSION['email'])){
	header("location: Wcreate.php");
  exit;
}
$email=$_SESSION['email'];
  $request="SELECT req.status, cust.phone , cust.Email, cust.Name from request as req right join workers as cust ON req.reciver=cust.Email where req.sender = '$email'AND req.status = 'accepted' ";
  $exec=mysqli_query($conn,$request);
  if (!$exec) {
    die("Error executing query: " . mysqli_error($conn));
}
if(mysqli_num_rows($exec)>0){
    header("location: hired.php");   
}else{
    header("location: hiredO.php");
}

?>