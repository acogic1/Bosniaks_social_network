<?php
    $con=mysqli_connect("localhost","root","","social_media") or die("Connection was not established");

    //function for insertong post
    function insertPost(){
        
        if(isset($_POST['sub'])){
            global $con;
            global $user_id;
            $content=addslashes($_POST['content']);
            

            if($content==''){
                echo "<h2>Please enter your Post</h2>";
                exit();
            }
            else{
                $insert = "insert into posts (user_id,post_content,post_date)
                values ($user_id,'$content',NOW())";
                $run=mysqli_query($con,$insert);
                
                

                if($run){
                    echo "<script>alert('Your Post Have Been Update Successifully.')</script>";

                    $update= "update users set posts='yes' where user_id=$user_id";
                    $run_update=mysqli_query($con,$update);
                }
            }
        }
    }

    function get_posts(){
        global $con;

        $per_page=4;
        
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        else{
            $page=1;
        }

        $start_from=($page-1) * $per_page;

        $get_post="select * from posts order by 1 DESC LIMIT $start_from,$per_page";

        $run_posts=mysqli_query($con,$get_post);

        while($row_posts=mysqli_fetch_array($run_posts)){
            $post_id=$row_posts['post_id'];
            $user_id=$row_posts['user_id'];
            $content=substr($row_posts['post_content'],0,70);
            $post_date=$row_posts['post_date'];

            // getting user who posted

            //$user="select * from users where user_id='$user_id' and posts='yes'";
            $user="SELECT * from users WHERE `user_id`=$user_id and posts='yes'";
            $run_users=mysqli_query($con,$user);
            $row_user=mysqli_fetch_array($run_users);

            $user_name=$row_user['user_name'];
            $user_image=$row_user['user_image'];

            //displaying all at once

            echo "
                <div id='posts'>
                    <p><img src='users/$user_image' width='80' height='80'></p>
                    <h3><a href='user_profile.php?u_id=$user_id'>$user_name</a>&nbsp<small style='color:black;'>Updated a post on $post_date</small></h3>
                    <p style='color:white;'>$content</p>
                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='fa fa-comment'>&nbspComment</button></a>
                </div><br><br>
            ";
        }
        include("pagination.php");
    }

    function single_post(){
        if(isset($_GET['post_id'])){
            global $con;

            $get_id=$_GET['post_id'];

            $get_post="select * from posts where post_id='$get_id'";

            $run_posts=mysqli_query($con,$get_post);

            $row_posts=mysqli_fetch_array($run_posts);

            $post_id=$row_posts['post_id'];
            $user_id=$row_posts['user_id'];
            $content=$row_posts['post_content'];
            $post_date=$row_posts['post_date'];

            //getting the user who posted
            $user="select * from users where user_id=$user_id and posts='yes'";

            $run_user=mysqli_query($con,$user);
            $row_user=mysqli_fetch_array($run_user);

            $user_name=$row_user['user_name'];
            $user_image=$row_user['user_image'];

            //getting the user emailby using SESSION
            $user_com=$_SESSION['user_email'];

            $get_com="select * from users where user_email='$user_com'";
            $run_com=mysqli_query($con,$get_com);
            $row_com=mysqli_fetch_array($run_com);

            $user_com_id=$row_com['user_id'];
            $user_com_name=$row_com['user_name'];

            //display all at once

            echo "
                <div id='posts'>
                    <p><img src='users/$user_image' width='80' height='80'></p>
                    <h3><a hred='user_profile.php?user_id=$user_id'>$user_name</h3>
                    <p>Posted On :$post_date</p>
                    <p>$content</p>
                </div>
            ";
            include("comments.php");

            echo "
                <br>
                <form method='post' id='reply'>
                    <textarea cols='50' rows='5' name='comment' placeholde='Comment.....'></textarea><br>
                    <input type='submit' name='reply' value='Comment'>
                </form>
            ";

            if(isset($_POST['reply'])){
                $comment=$_POST['comment'];
                $insert="insert into comments (post_id,user_id,comment,comment_author,date)
                        values($post_id,$user_id,'$comment','$user_com_name',NOW())";

                $run=mysqli_query($con,$insert);

                echo "<script>alert('You Reply is Addes!')</script>";

                echo "<script>window.open('single.php?post_id=$post_id','_self')</script>";
            }
        }
    }

    function find_people(){
        global $con;

        //select all users
        $user="select * from users";

        $run_user=mysqli_query($con,$user);

        while($row_user=mysqli_fetch_array($run_user)){
            $user_id=$row_user['user_id'];
            $user_name=$row_user['user_name'];
            $user_image=$row_user['user_image'];

            echo "
                <span>
                    <a href='user_profile.php?u_id=$user_id'><hr>
                    <strong><h2>$user_name</h2></strong>
                    <img src='users/$user_image' width='150px' height='140px' title='$user_name'
                        style='float:left; margin:1px;'/>
                        <br><br><br><br><br><br><br><br><br><br>
                    </a>
                </span>
            ";
        }
    }

    function user_posts(){
        global $con;

        if(isset($_GET['u_id'])){
            $u_id=$_GET['u_id'];
        }

        $get_posts="select * from posts where user_id=$u_id order by 1 DESC limit 5";

        $run_posts=mysqli_query($con,$get_posts);

        while($row_posts=mysqli_fetch_array($run_posts)){
            $post_id=$row_posts['post_id'];
            $user_id=$row_posts['user_id'];
            $content=$row_posts['post_content'];
            $post_date=$row_posts['post_date'];

            //getting the user who posted

            $user="select * from users where user_id=$user_id and posts='yes'";
            $run_user=mysqli_query($con,$user);
            $row_user=mysqli_fetch_array($run_user);

            $user_name=$row_user['user_name'];
            $user_image=$row_user['user_image'];

            //now displaying all posts at once

            echo "
                <div id='posts'>
                    <p><img src='users/$user_image' width='50' height='50'></p>
                    <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                    <p>$post_date</p>
                    <p>$content</p>
                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='fa fa-address-book'>&nbspView</button>
                    <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='fa fa-edit'>&nbspEdit</button>
                    <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='fa fa-trash-o'>&nbspDelete</button></a>
                </div><br>
            ";

            include("delete_post.php");
        }
    }

    function user_profile(){
        if(isset($_GET['u_id'])){
            global $con;

            $user_id=$_GET['u_id'];

            $select="select * from users where user_id=$user_id";
            $run=mysqli_query($con,$select);
            $row=mysqli_fetch_array($run);

            $id=$row['user_id'];
            $name=$row['user_name'];
            $describe_user=$row['describe'];
            $country=$row['user_country'];
            $image=$row['user_image'];
            $register_date=$row['user_reg_Data'];
            $gender=$row['user_gender'];
            
            if($gender=='Male'){
                $msg='Send him a message';
            }
            else{
                $msg='Send her a message';
            }

            echo "
                <div id='user_profile'>
                    <img src='users/$image' width='150' height='150' />
                    <br>

                    <p><strong>Name:</strong> $name</p><br>
                    <p><strong>Gender:</strong> $gender</p><br>
                    <p><strong>Country:</strong> $country</p><br>
                    <p><strong>Status:</strong> $describe_user</p><br>
                    <p><strong>Member Since:</strong> $register_date</p>
                    <a href='messages.php?u_id=$id'><button>$msg</button></a><hr>
                </div>
            ";
        }
    }
?>