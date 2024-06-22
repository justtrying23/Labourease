<?php
session_start();

include 'connection.php';
if($_SESSION['name']==''){
	header("location: Ccreate.php");
  exit;
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
      <link rel="stylesheet" href="css/hiredO.css">
        <title>hired</title>
    </head>
    <body>
        <div class="hired">
            <div class="navdiv">
                <div class="navbar">
                    <div class="logo"><a  style="color:black" href="User_page.php">
                    <img src="images/logo.png">
                    <h1>LABOURease</h1></a></div>
                    <div class="icons">
                    <span class="material-symbols-outlined md-48">account_circle</span>
                    <span id="profiledown-btn" class="material-symbols-outlined md-48" onclick="toggleMenu()">expand_more</span>
                    <div class="profile-dropdown">
                    <ul class="profile-dorpdown-list" style="list-style: none;">
                      <li class="list-item"><a href="manageAccount.html"><span class="material-symbols-outlined">manage_accounts</span><h4>Account</h4></a></li>
                      <li class="list-item"><a href="hiredO.html"><span class="material-symbols-outlined">groups</span><h4>Hired</h4></a></li>
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
                <a   href="User_page.html">Send Request</a>
                </div>
              </div>
        </div>
    </body>
</html>