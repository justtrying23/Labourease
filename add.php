<?php
session_start();
include 'connection.php';
if($_SESSION['adminname']==''){
	header("location: admin-login.php");
}

if(isset($_POST['categorysubmit'])){
 $category=$_POST['category'];
  
 $insert="INSERT INTO category (`Category`) VALUES('$category')";
    if(mysqli_query($conn, $insert)){
      echo"<script>alert('category added successfully');</script>";
    }else{
      echo"<script>alert('error');</script>";
    }
}

?>
<?php
$sql="SELECT * FROM `category`";
$result=mysqli_query($conn,$sql);
if(isset($_POST['tochange']) and isset($_POST['change'])){
  $from=$_POST['tochange'];
  $to=$_POST['change'];
  $update="UPDATE `category` SET `Category`='$to' WHERE `Category`='$from'";
  $ex=mysqli_query($conn,$update);
  if($ex==TRUE){
    echo "<script>
    alert('Entry updated'); 
    window.location='add.php'; 
    </script>";
  }
  else{
    echo "<script>
    alert('Error......try again'); 
    window.location='add.php'; 
    </script>";
  }
}

if(isset($_POST['delete'])){
$delete=$_POST['delete'];
$del="DELETE FROM `category` WHERE Category='$delete'";
$run=mysqli_query($conn,$del);
if(isset($_POST['yes'])){
if($run==TRUE){
  echo "<script>
  alert('Entry Deleted'); 
  window.location='add.php'; 
  </script>";
}
else{
  echo "<script>
  alert('Error......try again'); 
  window.location='add.php'; 
  </script>";
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
              <link rel="stylesheet" href="css/add1.css">
              <title>ADMIN</title>
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
            <a href="#">
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
         <div class="category">
          <form method="post" action="add.php">
            <fieldset>
            <legend >Add Category:</legend>
            <input type="text" id="category" name="category" autocomplete="off"><br>
            <input type="submit"  name="categorysubmit" value="ADD">
          </fieldset>
          </form>
         </div>
         <div class="faqs">
               <h1>Category</h1>
                <table>
                    <tr id="heading">
                        <th>Category</th>
                        <th>Function</th>
                    </tr>
                    <tbody>
                      <?php
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                          echo "<tr>";
                          echo"<td>".$row['Category']."</td>";
                          echo " <td>
                          <button onclick='editdpopup()'class='edit'><span class='material-symbols-outlined '>edit_note</span></button>
                          <button  onclick='deletepopup()' class='delete'><span class='material-symbols-outlined'>delete</span></button>
                          </td>";
                          echo"</tr>";
                        }
                      } 

                      ?>
                    </tbody>
                </table>
            </div>
    </div>
    
    <div class="popup" id="editpopup">
            <div class="overlay"></div>
            <div class="content">
                <div  onclick="editdpopup()" class="close-btn"><span class="material-symbols-outlined md-43">close</span></div>
                <form method="post" action="">
                    <input type="text" placeholder="category" name="tochange"><br>
                    <input type="text" placeholder="updated catgory"name="change"><br>
                    <button>SAVE</button>
                </form>
                
          </div>
          </div>
          <form method="post" action="">
          <div class="popup" id="deletepopup">
            <div class="overlay"></div>
            <div class="content">
              
            <input type="text" placeholder="Confirm category" name="delete"><br>
               <h2>are you sure. You want to Delete this entry?</h2>
               <button name="yes">yes</button>
               <button onclick="deletepopup()">no</button>
                    
            </div>
           
        </div>
        </form>
          <script>
            function editdpopup() {
                document.getElementById("editpopup").classList.toggle("active");
            }
            function  deletepopup(){
                document.getElementById("deletepopup").classList.toggle("active");
            }
        </script>
   </body>
</html>
