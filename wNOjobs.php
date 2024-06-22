<?php
session_start();
include'connection.php';

if(!isset($_SESSION['Wname']) || !isset($_SESSION['Wemail']) || empty($_SESSION['Wname']) || empty($_SESSION['Wemail'])){
	header("location: Wcreate.php");
  exit;
}
$email=$_SESSION['Wemail'];
$sql = "SELECT * FROM workers WHERE Email='$email'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<html>
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/icon.css">
      <link rel="stylesheet" href="css/hiredO.css">
        <title>your jobs</title>
        <style>
    .navbar .icons{
     display: flex;
     justify-content: end;
 }
          .icons .imabtn{
    width: 200px;
}
.navdiv .navbar .icons .imabtn .md-48{
    color: #fff;

}
.navdiv .navbar .icons .imabtn  img {
    max-width: 24%;
    border: 3px  #fff solid;
    border-radius: 100%;

}
 .navdiv .navbar .icons #profiledown-btn{
  cursor: pointer;
  color: black;
 }
        </style>
    </head>
    <body>
        <div class="hired">
            <div class="navdiv">
                <div class="navbar">
                    <div class="logo"><a  style="color:black" href="worker-page.php">
                    <img src="images/logo.png">
                    <h1>LABOURease</h1></a></div>
                    <div class="icons">
                    <div class="imabtn">
       <img src="images/<?php echo $row['image']?>">
       <span id="profiledown-btn" class="material-symbols-outlined md-48" onclick="toggleMenu()">expand_more</span>
      </div>
                    <div class="profile-dropdown">
                    <ul class="profile-dorpdown-list" style="list-style: none;">
                      <li class="list-item"><a href="Waccount.php"><span class="material-symbols-outlined">manage_accounts</span><h4>Account</h4></a></li>
                      <li class="list-item"><a href="worker-page.php"><span class="material-symbols-outlined span">manage_accounts</span><h4>home</h4></a></li>
                      <li class="list-item"><button>LOGOUT</button></li>
                    </ul>
                    </div>
                    </div>
                </div>
            </div>
            <script>
                let lllist=document.querySelector(".profile-dorpdown-list");
                function toggleMenu(){
                  lllist.classList.toggle("show");
                }
              </script>
              <div class="body">
                <div class="conatiner">
                <img src="images/Building Construction Site blue - Design Template Place.jpeg"><br>
                <a   href="worker-page.php">no accepted request yet </a>
                </div>
              </div>
        </div>
    </body>
</html>