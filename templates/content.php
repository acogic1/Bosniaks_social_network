<div id="body_section">
    <p style="font-family: verdana; font-weight: bold; color: green; position: relative; top: 35px; left: 155px;">
        Join the Largest Education Social Network.<br>
        Connect with Friends from School, Collage and University.
    </p>
    <div id="img">
        <img src="images/Bosniaks.jpg" height="300px" width="600px;">
    </div>
    <!--Left side content with image end -->
    <!--Rigth side content with image end -->
    <div id="right">
        <p style="font-size: 32px; color: green;font-weight:bold;">Create an Account</p>
        <p style="color: green;">
            <strong>
                It's Free and Always Will be:
            </strong>
        </p>
        <div id="form">
            <form id="signup_form" method="post">
                <table>
                    <tr>
                        <td>
                            <input type="text" name="u_name" required="required" placeholder="Full Name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="u_pass" required="required" placeholder="Enter Your Password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" name="u_email" required="required" placeholder="Enter Your Email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="u_country">
                                <option>Select a Country</option>
                                <option>Bosnia and Herzegovina</option>
                                <option>Croatia</option>
                                <option>Serbia</option>
                                <option>Montenegro</option>
                                <option>Kosovo</option>
                                <option>Slovenia</option>
                                <option>Macedonia</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Gender
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select name="u_gender">
                                <option>Select a Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            BirthDay
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="u_birthday" required="required">
                        </td>
                    </tr>

                </table>
                </div>
                <input style="width: 200px; height: 45px; font-weight: bold; background: #228B22;
                                border-radius: 5px; border: 0.5px solid #7FFF00; color: white;" type="submit" name="sign_up" value="Create an Account">
                <div>
                    <?php
                        include("insert_user.php");
                    ?>
                </div>
            </form>
        
    </div>
</div>