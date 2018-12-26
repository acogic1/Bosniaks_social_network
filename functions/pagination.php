<?php
    $query="select * from posts";

    $result=mysqli_query($con,$query);

    //count the total records

    $total_posts=mysqli_num_rows($result);

    //total ceil function to devide the total records on per page

    $total_pages=ceil($total_posts/$per_page);

    //going to first page

    echo "
        <center>
            <div id='pagination'>
                <a href='home.php?page=1'>First Page</a>
            
    ";

    for($i=1;$i<=$total_pages;$i++){
        echo "<a href='home.php?page=$i'>$i</a>";
    }

    //going to last page

    echo "<a href='home.php?page=$total_pages'>Last Page</a>";
?>