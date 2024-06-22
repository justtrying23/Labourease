<?php
session_start();

include 'connection.php';
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$sql="SELECT * FROM customer WHERE Name='$name' and Email='$email'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

if(isset($_POST['delete_account'])){
    $delete="DELETE FROM `customer` WHERE  Email='$email'";
    if(mysqli_query($conn,$delete)){
        echo"<script>
        alert('ACCOUNT DELETE.');
        window.location='Ccreate.php';
        </script>";
     } else{
        echo"<script>
        alert('there is an error try again');
        window.location='Security.php';
        </script>";
     }
}


if(isset($_POST['newpass']) and isset($_POST['conpass'])){
    $new=$_POST['newpass'];
    $confirm=$_POST['conpass'];
if($new==$confirm){
$update = "UPDATE customer SET Password='$confirm' WHERE  Email='$email' ";
if(mysqli_query($conn,$update)==TRUE){
    echo"<script>
    alert('Password is updated');
    window.location='Security.php';
    </script>";
 }else{
   echo"<script>
   alert('there is an error try again');
   window.location='Security.php';
   </script>";
 }
 }else{
    echo"<script>
   alert('password does not match');
   window.location='Security.php';
   </script>";
 }
}
?>
<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/icon.css">
      <link rel="stylesheet" href="css/security.css">
      <title>Manage_Accont</title>
    </head>
    <body>
        <div class="security-page">
            <div class="side_bar">
                <div class="logo">
                    <img src="images/logo.png"><a  style="color:black" href="User_page.php">
                    <h1>LABOURease</h1></a></div>
                <ul class="sidebar-list" style="list-style: none;">
                    <li class="list-item "><a href="manageAccount.php">Account info</a></li>
                    <li class="list-item active "><a href="Security.php">security</a></li>
                    <li class="list-button "><a href="logout.php"><button>LOGOUT</button></a></li>
                </ul>
            </div>
            <div class="security-info">
                <div class="basic_info">
                    <h1>Security</h1>
                    <div class="info_box">
                        <div class="box">
                            <div class="infocontainer">
                            <h3>Password</h3>
                                <h4><?php echo $row['Password']?></h4></div>
                                <span  onclick="passwordpopup()" class="material-symbols-outlined">chevron_right </span>
                        </div>
                        <div class="box">
                            <div class="infocontainer Delete">
                            <h2>Delete Account</h2>
                              </div>
                                <span onclick="deletepopup()" style="color: red;" class="material-symbols-outlined">chevron_right </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup" id="popup1">
            <div class="overlay"></div>
            <div class="content">
                <div  onclick="passwordpopup()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
                <form method="post" action="">
                    <input type="password" placeholder="New Password" name="newpass"><br>
                    <input type="password" placeholder="confirm Password" name="conpass"><br>
                    <button>SAVE</button>
                </form>
            </div>
        </div>
        <script>
            function  passwordpopup(){
                document.getElementById("popup1").classList.toggle("active");
            }
        </script>
        <div class="popup" id="popup2">
            <div class="overlay"></div>
            <div class="content">
                <form action="" method="post">
               <h2>are you sure. You want to Delete your Account?</h2>
               <button name="delete_account">yes</button>
               <button onclick="deletepopup()">no</button>
        </form>
            </div>
        </div>
        <script>
            function  deletepopup(){
                document.getElementById("popup2").classList.toggle("active");
            }
        </script>
    </body>
  </html>