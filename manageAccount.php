<?php
session_start();

include 'connection.php';
$name=$_SESSION['name'];
$email=$_SESSION['email'];
$sql="SELECT * FROM customer WHERE Name='$name' and Email='$email'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if(isset($_POST['save']))
{
   $imagename=$_POST['image'];
   $upd="update customer set image='$imagename' where Email='$email'";
   if(mysqli_query($conn,$upd)== TRUE)
   {
        echo "<script>
        alert('Image Updated'); 
        window.location='manageAccount.php'; </script>";
   }
   else{
    echo "<script>
        alert('Error... Try Again Later'); 
        window.location='manageAccount.php'; </script>";
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
      <link rel="stylesheet" href="css/Macc.css">
      <title>Manage_Accont</title>
    </head>
  
    <body>
  <div class="Account_info">
    <div class="side_bar">
        <div class="logo"><a  style="color:black" href="User_page.php">
             <img src="images\logo.png">
            <h1>LABOURease</h1></a></div>
        <ul class="sidebar-list" style="list-style: none;">
            <li class="list-item active"><a href="manageAccount.html">Account info</a></li>
            <li class="list-item "><a href="Security.php">security</a></li>
            <li class="list-button "><a href="logout.php"><button>LOGOUT</button></a></li>
        </ul>
    </div>
    <div class="profile_info">
    <div class="profile_pic">
    <img src="images/<?php echo $row['image']?>">
        <div onclick="imagepopup()" class="edit-btn">
        <span  class="material-symbols-outlined">edit </span>
    </div>
    </div>
    <div class="basic_info">
        <h1>Basic info</h1>
        <div class="info_box">
            <div class="box">
                <div class="infocontainer">
                <h3>Name</h3>
                    <h4><?php echo $row['Name'];?></h4></div>
                    <span class="material-symbols-outlined">chevron_right </span>
            </div>
            <div class="box">
                <div class="infocontainer">
                <h3>Phone number</h3>
                    <h4><?php echo $row['phone'];?></h4></div>
                    <span class="material-symbols-outlined">chevron_right </span>
            </div>
            <div class="box">
                <div class="infocontainer">
                <h3>Email</h3>
                    <h4><?php echo $row['Email'];?></h4></div>
                    <span class="material-symbols-outlined">chevron_right </span>
            </div>
        </div>
    </div>
</div>
  </div>
  <div class="popup" id="popup1">
    <div class="overlay"></div>
    <div class="content">
        <div  onclick="imagepopup()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
        <form method="post" action="">
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"><br>
            <button name="save" >SAVE</button>
        </form>
    </div>
</div>
<script>
    function  imagepopup(){
        document.getElementById("popup1").classList.toggle("active");
    }
</script>
    </body>
</html>