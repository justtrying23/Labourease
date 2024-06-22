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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accept_email'])) {
  $accept_email = $_POST['accept_email'];

  // Update the status in the database
  $update_query = "UPDATE request SET status='accepted' WHERE sender='$accept_email' AND reciver='$email'";
  if (mysqli_query($conn, $update_query)) {
      // Redirect to the same page to prevent form resubmission
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
  } else {
      echo "Error updating status: " . mysqli_error($conn);
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
        <link rel="stylesheet"type="text/css"href="css/workerpage.css">
</head>
<body>
<div class="navdiv">
  
  <div class="navbar">
      
  <div class="logo"><a  style="color:black" href="home-page.php">
     
   <img src="images/black-logo.png">
    
    <h1>LABOURease</h1></a></div>
  
      <div class="icons">
      <h1 > Hello <?php echo $row['Name'];?> !</h1>
          <div class="imabtn">
       <img src="images/<?php echo $row['image']?>">
       <span id="profiledown-btn" class="material-symbols-outlined md-48" onclick="toggleMenu()">expand_more</span>
      </div>
       
   <div class="profile-dropdown">
   
     <ul class="profile-dorpdown-list" style="list-style: none;">
        
  <li class="list-item"><a href="Waccount.php"><span class="material-symbols-outlined span">manage_accounts</span><h4>Account</h4></a></li>
  <li class="list-item"><a href="wrequestchk.php"><span class="material-symbols-outlined span">manage_accounts</span><h4>jobs</h4></a></li>

  
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
  <div class="dashboard"><img src="images/Wpage.jpg">
<div class="userInfo">
   <div class="header">
     <h1>Request</h1>
     <div class="sort">
      <span class="material-symbols-outlined">search</span>
        <input id="userSearch" type="search">
   </div>
<div>
  <?php
  $request="SELECT req.status, cust.phone , cust.Email, cust.Name from request as req right join customer as cust ON req.sender=cust.Email where req.reciver = '$email'AND req.status = 'pending' ";
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
   <th>Status</th> 
   </tr>
   <tbody>
   <?php

while($r_ow=mysqli_fetch_array($exec)){

?>
  <tr>
  <td><?php echo $r_ow["Name"]?></td>
  <td><?php echo $r_ow["Email"]?></td>
  <td>  <form method="post" action="">
                                <input type="hidden" name="accept_email" value="<?php echo $r_ow["Email"]; ?>">
                                <button type="submit">Accept</button>
                            </form></td>
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
<script>
         document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearch');
    const rows = document.querySelectorAll('.content table tr');
  
    searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.toLowerCase();
  
      rows.forEach(row => {
        // Check if the td elements exist before accessing their textContent
        const nameElement = row.querySelector('td:nth-child(1)');
        const emailElement = row.querySelector('td:nth-child(2)');
  
        const name = nameElement ? nameElement.textContent.toLowerCase() : '';
        const email = emailElement ? emailElement.textContent.toLowerCase() : '';
  
        const shouldDisplay = name.includes(searchTerm) || email.includes(searchTerm);
        row.style.display = shouldDisplay ? '' : 'none';
      });
    });
  });
  

      </script>
</body>
</html>