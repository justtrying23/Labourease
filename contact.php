<?php
include 'connection.php';
if( isset($_POST['name']) and isset($_POST['email']) and isset($_POST['message'])){
  $name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];

$sql = "INSERT INTO contact(Name,email, message) VALUES ('$name','$email','$message')"; 
if(mysqli_query($conn,$sql)==TRUE){
   echo"<script>
   alert('thankyou for contacting us');
   window.location='contact.php';
   </script>";
}else{
  echo"<script>
  alert('there is an error try again');
  window.location='contact.php';
  </script>";
}
}
?>

<html>
<head>
  <link rel="Stylesheet"  href="css/contactUS.css">
  <title>Contact us</title>
</head>
<body>
<div class="navbar">
            <div class="logo">
              <img src="images/black-logo.png">
              <h1>LABOURease</h1></div>
              <div class="link">
              <h3><a href="home-page.html">Home</h3></a>
              <h3><a href="aboutUs.html">About us</h3></a>
              <h3><a href="contact.php">Contact us</h3></a>
              </div>
              <div class="button">
                <a href="beforelog.html"><button class="login">LOGIN</button></a>
                <a href="get-started.html"><button class="singup">SINGUP</button></a>
              </div>
              </div>
  <div class="container">
    <form action="" method="post">

      <label  for="fname">First name</label>
      <input type="text" id="fname" name="name" placeholder="yourname. ." required><br>
      
      <label for="email">Email</label>
      <input type="text" id="email" name="email" placeholder="email. ." required><br>
       
       
       <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Write  something. ." style="height: 200px" required>
      </textarea><br>
    <input type="submit" value="Submit" name="submit">

    </form>
  </div>
</body>
</html>