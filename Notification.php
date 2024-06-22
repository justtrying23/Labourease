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
        <link rel="stylesheet" href="css/Notification.css">
        <title>Notification</title>
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
                  <a href="admin-login.php">
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
  <?php 
        $sql="select * from contact";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        {
            
        ?>
    <div class="table">
    <h1>Notification</h1>
    <?php
    function removeSpaces($str) {
    return str_replace(' ', '', $str);
}

while ($row = mysqli_fetch_assoc($result)) {
    $nameWithoutSpaces = removeSpaces($row['Name']);
    ?>
    <div class="day">
        <div onclick="<?php echo $nameWithoutSpaces ?>()" class="mesg">
            <span class="material-symbols-outlined notread">circle</span>
            <img src="images/user.png">
            <p><b><?php echo $row['Name'] ?></b> Wants to contact you</p>
        </div>
    </div>

    <div class="popup" id="<?php echo $row['Name'] ?>">
        <div class="overlay"></div>
        <div class="content">
            <div onclick="<?php echo $nameWithoutSpaces ?>()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
            <div class="contact">
                <div class="email">
                    <?php echo $row['email']; ?>
                </div>
                <div class="message">
                    <?php echo $row['message']; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.day .mesg');

            messages.forEach((message) => {
                message.addEventListener('click', () => {
                    const unreadSpan = message.querySelector('.notread');
                    if (unreadSpan) {
                        unreadSpan.classList.remove('notread');
                    }
                });
            });
        });

        function <?php echo $nameWithoutSpaces ?>() {
            document.getElementById("<?php echo $row['Name'] ?>").classList.toggle("active");
        }
    </script>
<?php
}
        }
?>


    </body>
</html>










