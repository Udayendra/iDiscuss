<?php
    $showError='false';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include "_dbconnect.php";
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
        $result=mysqli_query($conn, $sql);
        $numRows=mysqli_num_rows($result);
        if($result){
            if($numRows == 1){
                $row=mysqli_fetch_assoc($result);
                if(password_verify($password, $row['user_password'])){
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['useremail']=$user_email;
                    $_SESSION['sno']=$row['sno'];
                    $_SESSION['username']=$row['user_name'];
                    $showAlert=true;
                    header("location: ../index.php?loginsuccess=true");
                    exit();
                }
                else{
                    $showError='Incorrect password';
                }
                

            }
            else{
                $showError='Your data is not valid';
            }
        }
        header("location: ../index.php?loginsuccess=false&error=$showError");
    }
?>