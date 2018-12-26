<!DOCTYPE html>
<?php
    session_start();
    include("includes/connection.php");
    include("functions/function.php");
?>
<?php
    if(!isset($_SESSION['user_email'])){
        header("location: index.php");
    }
    else{
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Welcome Users!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/home_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card{
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            max-width: 660px;
            padding: 10px;
            margin: auto;
            text-align: center;
            font-family: ariall; 
        }
        .title{
            color: grey;
            font-size: 18px;
        }
        button{
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: green;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        a{
            text-decoration:none;
            font-size: 22px;
            color: black;
        }
        button:hover,a:hover{
            opacity:0.7;
        }
    </style>
</head>
<body>
    
        <div id="head_wrap">
            <div id="header">
                <ul id="menu">
                    <li><a class="fa fa-user" href="profile.php">&nbspProfile</a></li>
                    <li><a class="fa fa-home" href="home.php">&nbspHome</a></li>
                    <li><a class="fa fa-user-plus" href="members.php">&nbspFind People</a></li>
                    <li><a class="fa fa-envelope" href="my_messages.php?inbox">&nbspInbox</a></li>
                    <li><a class="fa fa-paper-plane" href="my_messages.php?sent">&nbspSent Messages</a></li>
                </ul>
                <form method="post" action="results.php" id="form1">
                    <input type="text" name="user_query" placeholder="Search">
                    <input type="submit" name="search" value="Search">
                </form>
            </div>
        </div>

        <div class="card">
            <div id="user_details">
                <?php
                    $user=$_SESSION['user_email'];
                    $get_user="select * from users where user_email='$user'";
                    $run_user=mysqli_query($con,$get_user);

                    $row=mysqli_fetch_array($run_user);

                    $user_id=$row['user_id'];
                    $user_name=$row['user_name'];
                    $describe_user=$row['describe'];
                    $Relationship_status=$row['Relationship'];
                    $user_country=$row['user_country'];
                    $user_image=$row['user_image'];
                    $register_date=$row['user_reg_Data'];
                    $gender=$row['user_gender'];
                    $user_birthday=$row['user_birthday'];

                    echo "
                        <img src='users/$user_image' style='width:100%;height:90%;' />
                        <form action='profile.php' method='post' enctype='multipart/form-data'>
                            <input type='file' name='u_image'><br><br>
                            <button name='update' class='fa fa-cloud-upload'>&nbspUpdate Profile</button>
                        </form>
                        <h1>$user_name</h1>
                        <p class='title'><strong> $describe_user</strong></p>
                        <p><strong>Lives In</strong> $user_country</p>
                        <p><strong>Member Since</strong> $register_date</p>
                        <p><strong>Gender</strong> $gender</p>
                        <p><strong>Date Of Brithday</strong> $user_birthday</p>

                        <div style='margin:24px 0;'>
                            <a href='logout.php'><button>Logout</button></a>
                        </div>
                    ";
                ?>
            </div>

            <?php
                if(isset($_POST['update'])){
                    $u_image=$_FILES['u_image']['name'];
                    $image_tmp=$_FILES['u_image']['tmp_name'];

                    move_uploaded_file($image_tmp,"users/$u_image");
                    $update="update users set user_image='$u_image' where user_id=$user_id";

                    $run=mysqli_query($con,$update);

                    if($run){
                        echo "<script>alert('Your Profile Updated!')</script>";
                        echo "<script>window.open('profile.php','_self')</script>";
                    }
                }
            ?>

        </div>
</body>
</html>

<?php } ?>