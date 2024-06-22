<?php
session_start();

include 'connection.php';
if($_SESSION['Wname']==''){
	header("location: Wcreate.php");
}
$SEemail=$_SESSION['Wemail'];
$sql = "SELECT * FROM workers WHERE Email='$SEemail'";
$result=mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

#------------------------------------for changeing password---------------------------------


if(isset($_POST['newpass']) and isset($_POST['conpass'])){
    $new=$_POST['newpass'];
    $confirm=$_POST['conpass'];
if($new==$confirm){
$update = "UPDATE workers SET Password='$confirm' WHERE  Email='$SEemail' ";
if(mysqli_query($conn,$update)==TRUE){
    echo"<script>
    alert('Password is updated');
    window.location='Waccount.php';
    </script>";
 }else{
   echo"<script>
   alert('there is an error try again');
   window.location='Waccount.php';
   </script>";
 }
 }else{
    echo"<script>
   alert('password does not match');
   window.location='Waccount.php';
   </script>";
 }
}

#----------------------------------------------for changeing category

 if(isset($_POST['category'])){
    $category=$_POST['category'];
$updatecat = "UPDATE workers SET category='$category'WHERE  Email='$SEemail'"; 
if(isset($_POST['catchange'])){  
if(mysqli_query($conn,$updatecat)==TRUE){
    echo"<script>
    alert('category is updated');
    window.location='Waccount.php';
    </script>";
 }else{
   echo"<script>
   alert('there is an error try again');
   window.location='Waccount.php';
   </script>";
 }
}
 }

#----------------------------------------------for changeing image


 if(isset($_POST['image'])){
    $image=$_POST['image'];
 $updateimg= "UPDATE workers SET image='$image'WHERE  Email='$SEemail'";
 if(mysqli_query($conn,$updateimg)){
    echo"<script>
    alert('image updated');
    window.location='Waccount.php';
    </script>";
 } else{
    echo"<script>
    alert('there is an error try again');
    window.location='Waccount.php';
    </script>";
 }

 }

 #----------------------------------------------for delete account

if(isset($_POST['delete_account'])){
    $delete="DELETE FROM `workers` WHERE  Email='$SEemail'";
    if(mysqli_query($conn,$delete)){
        echo"<script>
        alert('ACCOUNT DELETE.');
        window.location='Wcreate.php';
        </script>";
     } else{
        echo"<script>
        alert('there is an error try again');
        window.location='Waccount.php';
        </script>";
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
<link rel="stylesheet"type="text/css"href="css/Waccount.css">
<style>
        select{
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 70%;
        }
    </style>

     </head>
<body>
        <div class="side_bar">
            <div class="logo"><a  style="color:black" href="worker-page.php">
                 <img src="images\logo.png">
                <h1>LABOURease</h1></a></div>
            <ul class="sidebar-list" style="list-style: none;">
                <li class="list-item active"><a href="manageAccount.html">Account info</a></li>
                <li class="list-button "><a href="Wlogout.php"><button>LOGOUT</button></a></li>
                
            </ul>
        </div>
        <div class="info">
        <div class="profile_info">
            <div class="profile_pic">
                <img src="images/<?php echo $row['image'] ?>">
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
                            <h4><?php echo $row["Name"] ?></h4></div>
                            <span class="material-symbols-outlined">chevron_right </span>
                    </div>
                    <div class="box">
                        <div class="infocontainer">
                        <h3>Category</h3>
                            <h4><?php echo $row["category"] ?></h4></div>
                            <span onclick="catpopup()"  class="material-symbols-outlined">chevron_right </span>
                    </div>
                    <div class="box">
                        <div class="infocontainer">
                        <h3>Email</h3>
                            <h4><?php echo $row["Email"] ?></h4></div>
                            <span class="material-symbols-outlined">chevron_right </span>
                    </div>
                    <div class="box">
                        <div class="infocontainer">
                        <h3>Phone number</h3>
                            <h4> <?php echo $row["phone"] ?></h4></div>
                            <span class="material-symbols-outlined">chevron_right </span>
                    </div>
                   
             
                </div>
            </div>
        </div>
        <div class="security-info">
            <div class="basic_info">
                <h1>Security</h1>
                <div class="info_box">
                    <div class="box">
                        <div class="infocontainer">
                        <h3>Password</h3>
                            <h4><?php echo $row['Password'] ?></h4></div>
                            <span  onclick="passwordpopup()" class="material-symbols-outlined">chevron_right </span>
                    </div>
                    <div class="box">
                        <div class="infocontainer Delete">
                        <h2>Delete Account</h2>
                          </div>
                            <span onclick="deletepopup()" style="color: red;" class="material-symbols-outlined">chevron_right </span>
                    </div>
                </div>
            </div>
        </div>
     </div>
    </div>
    <div class="popup" id="popup1">
        <div class="overlay"></div>
        <div class="content">
            <div  onclick="passwordpopup()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
            <form action="#" method="POST">
            
                <input type="password" placeholder="New Password" name="newpass"><br>
                <input type="password" placeholder="confirm Password" name="conpass"><br>
                <button>SAVE</button>
            </form>
        </div>
    </div>
    <script>
        function  passwordpopup(){
            document.getElementById("popup1").classList.toggle("active");
        }
    </script>
    <div class="popup" id="popup2">
        <div class="overlay"></div>
        <div class="content">
          <form method="post" action="">
           <h2>are you sure. You want to Delete your Account?</h2>
           <button name="delete_account">yes</button>
           <button onclick="deletepopup()">no</button>
    </form>
        </div>
    </div>
    <script>
        function  deletepopup(){
            document.getElementById("popup2").classList.toggle("active");
        }
    </script>
    <div class="popup" id="imagepopup">
        <div class="overlay"></div>
        <div class="content" id="basicinfo">
            <div  onclick="imagepopup()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
            <form method="post" action="">
                <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png"><br>
                <button name="save" >SAVE</button>
            </form>
        </div>
    </div>
    <div class="popup" id="catpopup">
        <div class="overlay"></div>
        <div class="content" id="basicinfo">
            <div  onclick="catpopup()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
            <form method="post" action="">
            <select name="category" id="category" >
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
                <button name="catchange" >change</button>
            </form>
        </div>
    </div>
    <script>
        function  catpopup(){
            document.getElementById("catpopup").classList.toggle("active");
        }
        function  imagepopup(){
            document.getElementById("imagepopup").classList.toggle("active");
        }
    </script>
</body>

</html>

