<?php
$showError="flase";
if($_SERVER['REQUEST_METHOD']=='POST'){
    include "_dbconnect.php";
    $user_name=$_POST['username'];
    $user_email=$_POST['signupEmail'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    // check whether this email exist or not
    $existsql = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
    $result = mysqli_query($conn, $existsql);
    $existrow=mysqli_num_rows($result);
    if($existrow>0){
        $showError='User already exist';
    }
    else{
        if($password==$cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_name`, `user_email`, `user_password`, `timestamp`) VALUES ('$user_name', '$user_email', '$hash', current_timestamp())";
            $result=mysqli_query($conn, $sql);
            if($result){
                $showAlert=true;
                header("location: ../index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError= 'Password does not match';
            
        }
    }
    header("location: ../index.php?signupsuccess=false&error=$showError");
    
    
}
?>