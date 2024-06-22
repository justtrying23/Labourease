<?php
session_start();

include 'connection.php';
if($_SESSION['name']==''){
	header("location: Ccreate.php");
  exit;
}
$name=$_SESSION["name"];
$email=$_SESSION['email'];
  $pic="SELECT * FROM customer WHERE Name='$name' and Email='$email'";
$xhange=mysqli_query($conn,$pic);
$rows=mysqli_fetch_array($xhange);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="css/icon.css">
      <link rel="stylesheet" href="css/user-page1.css">
   
    <title>Document</title>
</head>
<body>
    <div class="userpage">
        <div class="navdiv">
    <div class="navbar">
        <div class="logo"><a  style="color:black" href="home-page.php">
        <img src="images/black-logo.png">
        <h1>LABOURease</h1></a></div>
        
        <div class="icons">
         <h1 > Hello <?php echo $_SESSION['name'];?>!</h1>
          <div class="imabtn">
          <img src="images/<?php echo $rows['image']?>">
            <span id="profiledown-btn" class="material-symbols-outlined md-48" onclick="toggleMenu()">expand_more</span>
          </div>          
        <div class="profile-dropdown">
        <ul class="profile-dorpdown-list" style="list-style: none;">
          <li class="list-item"><a href="manageAccount.php"><span class="material-symbols-outlined span">manage_accounts</span><h4>Account</h4></a></li>
          <li class="list-item"><a href="hiredchk.php"><span class="material-symbols-outlined span">groups</span><h4>Hired</h4></a></li>
          <li class="list-item"><a href="logout.php"><button>LOGOUT</button></a></li>
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
<div class="image"><img src="images\pexels-engin-akyurt-4170184.jpg">
<div class="search">
    <div>
        <form action="" method="post">
           <label>What are you looking for?</label>
            <select name="jobs" id="jobs">
            <option style="color:#717070;"disabled selected value="">Select a category</option>
            <?php
            $sql="select * from category";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)> 0)
            {
                while($row=mysqli_fetch_array($result))
                {
                  ?>
                    <option value="<?php echo $row['Category'] ?>"><?php echo $row['Category'] ?></option>
                  <?php
                }
              }
             ?>
            
           </select><br>
          <input type="number" placeholder="Enter number" name="number"><br>
          <button name="search">SEARCH</button>
             
        </form>
    </div>
</div>
   

<?php
if (isset($_POST['search'])) {
    $cat = $_POST['jobs'];
    $num = (int)$_POST['number'];
    $workerQuery = "SELECT * FROM workers WHERE category='$cat'";
    $result = mysqli_query($conn, $workerQuery);
    $workers = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $workers[] = $row;
    }

    if (count($workers) > 0 && count($workers) <= $num) {
        $_SESSION['worker_emails'] = implode(',', array_column($workers, 'Email'));
        echo "<div class='worker_info'>
                <h1>CHOOSE</h1><br>
                <h3>Recommended</h3>";
        foreach ($workers as $worker) {
            echo "<div class='card'>
                    <div class='description'>
                        <img src='images/" . htmlspecialchars($worker['image']) . "'>
                        <h3>" . htmlspecialchars($worker['Name']) . "</h3>
                        <h5>" . htmlspecialchars($worker['category']) . "</h5>
                    </div>
                    <span class='material-symbols-outlined'>phone_in_talk</span>
                  </div>";
        }
        echo "<form method='post' action=''>
                <button name='sendreq'>Send Request</button>
              </form>
              </div>";
    } else {
        echo "<div class='description'>No workers found :(</div>";
    }
}
?>

<?php
if (isset($_POST['sendreq'])) {
    if (isset($_SESSION['email']) && isset($_SESSION['worker_emails'])) {
        $email = $_SESSION['email'];
        $workerEmails = $_SESSION['worker_emails'];
        $status = 'pending';

        // Split worker emails into an array
        $workerEmailsArray = explode(',', $workerEmails);

        $newWorkerEmails = [];
        foreach ($workerEmailsArray as $workerEmail) {
            $checkQuery = "SELECT * FROM request WHERE sender='$email' AND FIND_IN_SET('$workerEmail', reciver)";
            $checkResult = mysqli_query($conn, $checkQuery);
            if (mysqli_num_rows($checkResult) == 0) {
                $newWorkerEmails[] = $workerEmail;
            }
        }

        if (!empty($newWorkerEmails)) {
            $newWorkerEmailsString = implode(',', $newWorkerEmails);
            $sql = "INSERT INTO request (sender, reciver, status) VALUES ('$email', '$newWorkerEmailsString', '$status')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "<script>
                alert('Request sent successfully'); 
                window.location='User_page.php'; 
                </script>";
            } else {
                echo "<script>
                alert('Sorry, we are having an issue. Please try again later.'); 
                window.location='User_page.php'; 
                </script>";
            }
        } else {
            echo "<script>
            alert('You have already sent a request to these workers.'); 
            window.location='User_page.php'; 
            </script>";
        }
    } else {
        echo "Session expired or data missing. Please try again.";
    }
}
?>



</body>
</html>