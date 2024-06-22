<?php
session_start();
include 'connection.php';
if($_SESSION['adminname']==''){
	header("location: admin-login.php");
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
              <link rel="stylesheet" href="css/User-info1.css">
        <title>WORKER INFO</title>
    </head>
    <body>
        <nav class="sidebar close">
            <header>
              <div class="image-text">
                <span>
                <img src="images/black-logo.png"></span>
                <div class="text">
                  <span class="name">LABOURease</span>
                </div>
              </div>
              <div onclick="show()">
              <span id="arrow" style="color: #fff;">></span></div>
            </header>
      
            <div class="menu-bar">
            <div class="menu">
          <ul class="menu-links">
            <li class="nav-link">
              <a href="analatics.php">
                <span class="material-symbols-outlined md-44">bar_chart</span>
                <span class="text nav-text">Analatics</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="add.php">
                <span class="material-symbols-outlined md-44">add</span>
                <span class="text nav-text">Add +</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="User-info.php">
                <span class="material-symbols-outlined md-44">engineering</span>
                <span class="text nav-text">Workers</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="customer_info.php">
                <span class="material-symbols-outlined md-44">person_search</span>
                <span class="text nav-text">Customers</span>
              </a>
            </li>
            <li class="nav-link">
              <a href="Notification.php">
                <span class="material-symbols-outlined md-44">notifications</span>
                <span class="text nav-text">Notification</span>
              </a>
            </li>
          </ul>
        </div>
      
              <div class="bottom-content">
                <li class="" style="margin-left: -6px;">
                  <a href="admin-logout.php">
                    <span class="material-symbols-outlined md-44">logout </span>
                  <span class="text nav-text">LOGOUT</span>
                  </a>
      
              </div>
            </div>
          </nav>
          <script>
            function show() {
              const sidebar = document.querySelector(".sidebar");
            
              document.getElementById("arrow").addEventListener("click", () => {
                sidebar.classList.toggle("close");
              });
            }
            
            show();
            
          </script>
 
          <div class="dashboard">
            <div class="userInfo">
            <div class="header">
                    <h2>WORKER LIST</h2>
                    <div class="sort"><span class="material-symbols-outlined">search</span>
                        <input type="search" id="userSearch"  placeholder="search user">
                    </div>
                </div>
                <div class="content">
                <p>All Users: </p>
                   <table>
                    <tr id="heading">
                      <th>profile</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Email</th>
                      <th>Phone</th>
                    </tr>
                    <tbody>
                      <?php
                      $select="SELECT `Name`, `image`, `Email`,`category`,  `phone` FROM `workers` ";
                       $result=mysqli_query($conn, $select) or die('Query failed'.mysqli_error($conn));
                      if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                          echo "<tr>";
                          echo"<td><img src=images/".$row['image']."></td>";
                          echo"<td>".$row['Name']."</td>";
                          echo"<td>".$row['category']."</td>";
                          echo"<td>".$row['Email']."</td>";
                          echo"<td>".$row['phone']."</td>";
            
                        }
                      } 

                      ?>
                    </tbody>
                   </table>
                </div>
            </div>
          </div>
      <script>
         document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('userSearch');
    const rows = document.querySelectorAll('.content table tr');
  
    searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.toLowerCase();
  
      rows.forEach((row, index) => {
                // Skip the first row (header row)
                if (index === 0) return;
        const nameElement = row.querySelector('td:nth-child(2)');
        const emailElement = row.querySelector('td:nth-child(3)');
        const dateElement = row.querySelector('td:nth-child(4)');
  
        const name = nameElement ? nameElement.textContent.toLowerCase() : '';
        const email = emailElement ? emailElement.textContent.toLowerCase() : '';
        const date = dateElement ? dateElement.textContent.toLowerCase() : '';

  
        const shouldDisplay = name.includes(searchTerm) || email.includes(searchTerm)|| date.includes(searchTerm);
        row.style.display = shouldDisplay ? '' : 'none';
      });
    });
  });
  

      </script>

    </body>
</html>