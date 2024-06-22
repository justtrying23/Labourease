<?php
session_start();
include 'connection.php';


if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $select = mysqli_query($conn, "SELECT * FROM workers WHERE Email= '$email' AND Password = '$password'AND Name ='$name'") /*or die('query is failed')*/;
 
    if(mysqli_num_rows($select) > 0){
           $message[]= 'User already exists';
    } else{
        $insert = mysqli_query($conn, "INSERT INTO `workers` VALUES('$name','user.png', '$email','$category','$password','$phone')")or die(mysqli_error($conn));
        if($insert == TRUE){
        
            echo "<script>
            alert('Registration Done'); 
            window.location='Wcreate.php'; 
            </script>";
        
            
        } else {
            $message[] = 'Failed to register user';
        }
    }
}
?>

<?php
if(isset($_POST['lemail']) and isset($_POST['pas']))
{
$lemail=$_POST['lemail'];
$pass=$_POST['pas'];

$select="SELECT * FROM workers where Email='$lemail' and Password='$pass'";
$result=mysqli_query($conn,$select) ;
$row=mysqli_fetch_array($result);
if(mysqli_num_rows($result)==1)
{
    $_SESSION['Wname']=$row['Name'];
	$_SESSION['Wemail']=$row['Email'];
header('location:worker-page.php');

}else{
$message[] = 'Incorrect username or password!';
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
    <link rel="stylesheet" href="css/icon.css">
   <link rel="stylesheet" href="css/create.css">
    <title>create</title>
	<style>
        .logo{
    position: absolute;
    left: 0;
    top: 0;
    display: flex;
    align-items: center;
    float: left;
    width: 20%;
    padding: 20px;
}
.logo img{
    max-width: 25%;
}
.logo h1{
font-size: 25px;
}
        select{
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }
    </style>

</head>
<body>
<a href="home-page.php">
    <div class="logo">
        <img src="images/re-logo.png">
        <h1>LABOURease</h1>
    </div></a>
    <?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message">'.$message.'</div>';
    }
}
?>
    <h2>For Workers</h2>
    <p id="head">Take control of your construction work and expand your opportunities by joining our platform</p>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="#" method="post" >
			<h1>Create Account</h1>

			<input type="text" placeholder="Name" name="name" required>
			<input type="email" placeholder="Email" name="email" required>
			<input type="password" placeholder="Password" name="pass" required>
			<input type="number" placeholder="Phone Number" name="phone" required/>
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
              </select>
			<button name="submit">Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="#" method="post" >
			<h1>Login</h1>
			<input type="email" placeholder="Email" name="lemail" required/>
			<input type="password" placeholder="Password" name="pas" required/>
			<a href="#">Forgot your password?</a>
			<button name="login">Login</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Login</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
</footer>
<script>
    const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script>
</body>
</html>