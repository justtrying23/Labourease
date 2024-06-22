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
        $insert = mysqli_query($conn, "INSERT INTO user_info (Name, Email, Phone, Password) VALUES ('$name', '$email', '$phonenum', '$password')")or die(mysqli_error($conn));
        if($insert){
            header("location:User_page.php");
        } else {
            $message[] = 'Failed to register user';
        }
    }
}
?>