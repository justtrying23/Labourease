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
        <link rel="stylesheet" href="css/analatics.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <title>Analatics</title>
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
            <div class="customer">
              <h1>User <span class="material-symbols-outlined">trending_up</span></h1>
              <p><b>523651</b><br>
                <span class="material-symbols-outlined">north</span> <span>5.65%</span> in last month
               </p>
            </div>
            <div class="workers">
              <h1> worker<span class="material-symbols-outlined">trending_down</span> </h1>
                <p><b>523651</b><br>
                <span class="material-symbols-outlined">south</span> <span>2.65%</span> in last month
               </p>
            </div>
            <div class="notification">
              <h1>Notification  <a href="Notification.php" ><button>View All</button></a></h1>
              <div class="contable">
                <?php
                 $sql="select Name from contact";
                 $result=mysqli_query($conn,$sql);
                 if(mysqli_num_rows($result)>0)
                 { while($row=mysqli_fetch_assoc($result)){
                ?>
                <div class="con">
                  <p><?php echo $row['Name'];?> wants to contact you</p>
                </div>
                <?php
                 }}
                ?>
                
              </div>
             </div>
            <div class="chart"><canvas id="myChart" style="width:100%;max-width:650px"></canvas>
            </div>
        </div>  
  <script>
    const xValues = ["plumber", "mason", "painter", "electrecian", "contractor"];
const yValues = [55, 49, 44, 24, 30];
const barColors = ["red", "green","blue","orange","pink"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Most Hierd Feilds"
    }
  }
});
  </script>
    </body>
</html>