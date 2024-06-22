<?php
include 'connection.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $phonenum = mysqli_real_escape_string($conn, $_POST['phonenum']);

    $select = mysqli_query($conn, "SELECT * FROM user_info WHERE Email= '$email' AND Password = '$password'AND Name ='$name'") /*or die('query is failed')*/;
 
    if(mysqli_num_rows($select) > 0){
           $message[]= 'User already exists';
    } else{
        $insert = mysqli_query($conn, "INSERT INTO `user_info`(`Image`, `Name`, `Email`, `Phone`, `Password`, `SingUp_as`, `Category`) VALUES('null','$name', '$email', '$phonenum', '$password','2','2')")or die(mysqli_error($conn));
        if($insert == TRUE){
            header("location:user_page.php");
           
        } else {
            $message[] = 'Failed to register user';
        }
    }
}
?>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&family=Roboto:wght@100;300;500&display=swap" rel="stylesheet">
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
            <link rel="stylesheet" href="css/icon.css">
    <link rel="stylesheet" href="css/sing-up1.css">
    <title>Document</title>
</head>
<body>
    <div class="sing-up">
    <?php

        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
            }
        }
        ?>
<form id="singup-form" action="sing-up.php" method="post">
    <div class="form-control">
        <input type="text" name="name" id="name" placeholder="User name" required autocomplete="off">
        <span class="material-icons-outlined icons-error">error</span>
        <span class="material-icons-outlined icons-success">check_circle</span><br>
        <small id="nameError" class="error"></small><br><br>
    </div>
    <div class="form-control">
        <input type="text" name="email" id="email" placeholder="Email" required autocomplete="off">
        <span class="material-icons-outlined icons-error">error</span>
        <span class="material-icons-outlined icons-success">check_circle</span><br>
        <small id="emailError" class="error"></small><br><br>
    </div>
    <div class="form-control">
        <input type="password" name="pass" id="pass" placeholder="Password" required autocomplete="off">
        <span class="material-icons-outlined icons-error">error</span>
        <span class="material-icons-outlined icons-success">check_circle</span><br>
        <small id="passError" class="error"></small><br><br>
    </div>
    <div class="form-control">
        <input type="text" name="phonenum" id="phonenum" placeholder="Phone number" required autocomplete="off">
        <span class="material-icons-outlined icons-error">error</span>
        <span class="material-icons-outlined icons-success">check_circle</span><br>
        <small id="phonenumError" class="error"></small><br><br>
    </div>
    <input type="submit" name="submit" value="SINGUP" onclick="validation()">
    <br><br>
    <label for="login" name="login" id="login">Already have an account?<a href="log-in.html">LOGIN</a></label>
</form>

    </div>
    <!-- <script>
    const form = document.getElementById("submit")

    form.addEventListener('submit', (event) => {
        event.preventDefault();
        validation();
    })

    function validation() {
        validateField("name");
        validateField("email");
        validateField("pass");
        validateField("phonenum");
    }

    function validateField(fieldName) {
        const input = document.getElementById(fieldName);
        const small = document.getElementById(fieldName + "Error");
        const errorIcon = document.querySelector(`#${fieldName} + .material-icons-outlined.icons-error`);
        const successIcon = document.querySelector(`#${fieldName} + .material-icons-outlined.icons-success`);

        const value = input.value.trim();

        if (value === "") {
            setErrorMsg(input, small, errorIcon, "Field cannot be empty");
        } else if (fieldName === "email" && (value.indexOf('@') <= 0 || (value.charAt(value.length - 4) !== '.' && value.charAt(value.length - 3) !== '.'))) {
            setErrorMsg(input, small, errorIcon, "Enter a valid email");
        } else if (fieldName === "phonenum" && (isNaN(value) || value.length !== 10 || (value.charAt(0) !== '9' && value.charAt(0) !== '7' && value.charAt(0) !== '8'))) {
            setErrorMsg(input, small, errorIcon, "Enter a valid number");
        } else {
            setSuccessMsg(input, small, errorIcon, successIcon);
        }
    }

    function setErrorMsg(input, small, errorIcon, errorMsg) {
        input.classList.remove("success");
        input.classList.add("error");
        small.innerText = errorMsg;
        errorIcon.style.visibility = "visible";
    }

    function setSuccessMsg(input, small, errorIcon, successIcon) {
        input.classList.remove("error");
        input.classList.add("success");
        small.innerText = '';
        errorIcon.style.visibility = "hidden";
        successIcon.style.visibility = "visible";
    }
</script> 
 -->

</body>
</html>

