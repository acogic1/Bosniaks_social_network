<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bosniaks Login and SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  media="all" href="styles/style.css" />
</head>
<body>
    <div id="main-container">
        <div id="header">
        <div id="logo">
            Bosniaks
        </div>
        <div class="login_form">
            <form method="post" id="login_form">
                <table>
                    <tbody>
                        <tr>
                            <td>Email</td>
                            <td>Password</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="Email" name="email" placeholder="Enter Your Email" required="required">
                            </td>
                            <td>
                                <input type="Password" name="pass" placeholder="Enter Your Password" required="required">
                            </td>
                            <td>
                                <button id="btn1" name="login">Login</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox">
                                <span style="text-decoration: none; color: #7FFF00;">Keep me Logged in</span>
                            </td>
                            <td>
                                <a style="text-decoration: none; color: #7FFF00;" href="#">Forgotten Password?</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>