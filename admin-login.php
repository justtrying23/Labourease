<?php
session_start();
include 'connection.php';

if(isset($_POST['submit'])){
  if(isset($_POST['name']) && isset($_POST['pas'])){
      $name=$_POST['name'];
      $pass=$_POST['pas'];

      $select="SELECT * FROM admin";
      $result=mysqli_query($conn,$select) ;
      $row=mysqli_fetch_array($result);

      if($row['Name']== $name && $row['Password']==$pass){
          $_SESSION['adminname']=$row['Name'];
          header('location:analatics.php');
          exit();
      } else {
          $message[] = 'Incorrect username or password!';
      }
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
     <title>LOGIN</title>
     <link rel="stylesheet" href="css/Admin-login.css">
    </head>
    <body>
        <div class="admin-login">
        <?php

if(isset($message)){
    foreach($message as $message){
    echo '<div class="message">'.$message.'</div>';
   }
  }
?>
        <form method="post" action="Admin-login.php">
            <input type="text" placeholder="Username" name="name" ><br><br>
            <input type="password" placeholder="Password" name="pas" required><br><br>
            <input type="submit" name="submit" value="LOGIN">  
        </form>
    </div>
    </body>
</html>