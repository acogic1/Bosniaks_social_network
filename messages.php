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
</head>
<body>
    <div class="container">
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
        <div class="content">
            <div id="user_timeline">
                <div id="user_details">
                    <?php
                        $user=$_SESSION['user_email'];
                        $get_user="select * from users where user_email='$user'";
                        $run_user=mysqli_query($con,$get_user);
                        $row=mysqli_fetch_array($run_user);

                        $user_id=$row['user_id'];
                        $user_name=$row['user_name'];
                        $describe_user=$row['describe'];
                        $user_image=$row['user_image'];

                        $user_posts="select * from posts where user_id=$user_id";
                        $run_posts=mysqli_query($con,$user_posts);
                        $posts=mysqli_num_rows($run_posts);

                        //get number unread message
                        $sel_msg="select * from messages where receiver=$user_id and status='unread' order by 1 DESC";
                        $run_msg=mysqli_query($con,$sel_msg);
                        $count_msg=mysqli_num_rows($run_msg);

                        echo "
                            <center>
                                <img src='users/$user_image' width='200' height='200'/>
                            </center>
                            <div id='user_mention'>
                                <p><center><h2>$user_name</h2></center>
                                <center><strong>$describe_user</strong></center></p>

                                <p class='fa fa-group'>&nbsp<a href='my_messages.php?inbox&u_id=$user_id'>Messages ($count_msg)</a></p>

                                <p class='fa fa-user-o' >&nbsp<a href='my_post.php?u_id=$user_id'>My Posts ($posts)</a></p>
                                <p class='fa fa-paint-brush'>&nbsp<a href='edit_profile.php?&u_id=$user_id'>Edit my Account</a></p>
                                <p class='fa fa-mouse-pointer'>&nbsp<a href='logout.php'>Loguot</a></p>
                            </div>
                        ";
                    ?>
                </div>
            </div>
            <div id="message">
                <?php
                    if(isset($_GET['u_id'])){
                        $u_id=$_GET['u_id'];

                        $sel="select * from users where user_id=$u_id";
                        $run=mysqli_query($con,$sel);
                        $row=mysqli_fetch_array($run);

                        $user_name=$row['user_name'];
                        $user_image=$row['user_image'];
                        $reg_date=$row['user_reg_Data'];
                    }
                ?>

                <h2 style="text-align: center;">Send a Message to <span style="color:red;"><?php echo $user_name; ?></span></h2>

                <form action="messages.php?u_id=<?php echo $u_id; ?>" method="post" id="f">
                    <br>
                    <div style="background-color: green;  padding: 20px;">
                        <center>
                            <h2>Subject</h2><br>
                            <input type="text" name="msg_title" placeholder="Hello Coding Cafe..." size="49"/>
                        </center>
                        <br><hr>
                    </div>
                    <div style="background-color: green;  padding: 20px;">
                        <center>
                            <h2>Message</h2><br>
                            <textarea name="msg" cols="50" rows="5" placeholder="Leave Your Message Here..."></textarea><br>
                            <input type="submit" name="message" value="Send Message"/>
                        </center>
                    </div>
                </form><br>
                <div style="background-color: green;  padding: 20px;">
                    <center>
                        <h2>Information About <?php echo $user_name; ?></h2><br>
                        <img style="border: 1px solid blue; border-radius: 5px;" src="users/<?php echo $user_image; ?>" width="100" height="100">
                        <p><strong><?php echo $user_name; ?></strong> is member of this site since: <?php echo $reg_date; ?></p>
                    </center>
                </div>
            </div>

            <?php
                if(isset($_POST['message'])){
                    $msg_title=$_POST['msg_title'];
                    $msg=$_POST['msg'];

                    $insert="insert into messages (sender,receiver,msg_sub,msg_topic,reply,status,msg_Date)
                    values('$user_id','$u_id','$msg_title','$msg','no_reply','unread',NOW())";

                    $run_insert=mysqli_query($con,$insert);

                    if($run_insert){
                        echo "<script>alert('Message was sent to ".$user_name." Successfully')</script>";
                    }
                    else{
                        echo "<script>alert('Message was not sent...!')</script>";
                    }
                }
            ?>

        </div>
    </div>
</body>
</html>

<?php } ?>