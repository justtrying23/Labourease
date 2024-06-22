
<?php
session_start();
include'connection.php';

if(!isset($_SESSION['Wname']) || !isset($_SESSION['Wemail']) || empty($_SESSION['Wname']) || empty($_SESSION['Wemail'])){
	header("location: Wcreate.php");
  exit;
}
$email=$_SESSION['Wemail'];
$sql="SELECT * FROM `workers` WHERE Email='$email' ";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
?>
<html>
    <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/icon.css">
      <link rel="stylesheet" href="css/hiredO.css">
        <title>your jobs</title>
        <style>

          .userInfo{
  position: relative;
  top: 50px;
  left: 100px;
 margin: 50px;
 width: 80%;
 z-index: -1;
}
.userInfo .header {
  background-color:#fff;
 border: 1px #000 solid;
 padding:30px 0px 30px 30px;
 width: 100%;
 margin-bottom: 10px;
 border-radius: 10px;
}
.userInfo .header h1{
  padding-bottom: 10px;
}
.userInfo .header .sort input[type='search']{
 padding: 10px;
 border-radius: 5px;
 border: 1px #000 solid;
 padding-left: 35px;
 width: 450px;
 position: relative;
}
.userInfo .header .sort select{
 padding: 10px;
 border-radius: 5px;
 width: 150px;
}
.userInfo .header .sort select option{
 text-transform: capitalize;
}
.userInfo .header .sort span{
 position: absolute;
 font-size: 25px;  
 left: 40px;
 top: 87px; 
 color: #979393;
 z-index: 2;
}


/*=====================================================content============================================================*/
.content{
 width: 80%;
 padding: 20px;
 background-color: #fff;
 border:1px #000 solid;
 margin-top:20px;
 border-radius: 10px;
}
.content p{
font-size: 20px;
font-weight: 600;
}
table{
 width: 100%;
 margin: 0px;
}

.content table #heading{
 background-color: #DDD;
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
                    <img style=" max-width: 10%; border: 3px  #fff solid; border-radius: 100%;" src="images/<?php echo $row['image']?>">
                    <span id="profiledown-btn" class="material-symbols-outlined md-48" onclick="toggleMenu()">expand_more</span>
                    <div class="profile-dropdown">
                    <ul class="profile-dorpdown-list" style="list-style: none;">
                      <li class="list-item"><a href="Waccount.php"><span class="material-symbols-outlined">manage_accounts</span><h4>Account</h4></a></li>
                      <li class="list-item"><a href="worker-page.php"><span class="material-symbols-outlined span">manage_accounts</span><h4>home</h4></a></li>
                      <li class="list-item"><a href="Wlogout.php"><button>LOGOUT</button></a></li>
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
            <div class="userInfo">
   <div class="header">
     <h1>Request</h1>
     <div class="sort">
      <span class="material-symbols-outlined">search</span>
        <input id="userSearch" type="search">
   </div>
<div>
  <?php
  $request="SELECT req.status, cust.phone , cust.Email, cust.Name from request as req right join customer as cust ON req.sender=cust.Email where req.reciver = '$email'AND req.status = 'accepted' ";
  $exec=mysqli_query($conn,$request);
  if (!$exec) {
    die("Error executing query: " . mysqli_error($conn));
}


  ?>
<div class="content">
 <table >
   <tr id="heading">
   <th>Name</th>
   <th>Email</th>
   <th>phone</th> 
   </tr>
   <tbody>
   <?php

while($r_ow=mysqli_fetch_array($exec)){

?>
  <tr>
  <td><?php echo $r_ow["Name"]?></td>
  <td><?php echo $r_ow["Email"]?></td>
  <td> <?php echo $r_ow["phone"]?></td>
  </tr>
  <?php
    } 
?>
   </tbody>
</table>
</div>
</div>
</div>
</div>
    </body>
</html>