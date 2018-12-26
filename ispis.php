<?php
    session_start();
    include("includes/connection.php");
    
    if(isset($_POST['login'])){
        $email=mysqli_real_escape_string($con, $_POST['email']);
        $pass=mysqli_real_escape_string($con, $_POST['pass']);

        $select_user="select * from users where user_email='$email' and user_pass='$pass'
        and status='verified'";
        echo "<script>alert('Incorrect details, try again! $select_user')</script>";

        $query=mysqli_query($con,$select_user);

        $check_user=mysqli_num_rows($query);

        if($check_user==1){
            $_SESSION['user_email']=$email;

            echo "<script>window.open('home.php','-self')</script>";
        }
        else{
            echo "<script>alert('Incorrect details, try again!')</script>";
        }
    }
?>