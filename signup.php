<?php

?>
<!DOCTYPE <!DOCTYPE html>
<html>
    <head>
        <style>
            body {
                background-color: #ddd;
                color: black;
            }
            h1 {
                text-align: center;
                padding: 0px 4px;
            }
            .container {
                max-width: 400px;
                margin: 2% auto 5%;
                padding: 40px;
                box-sizing: border-box;
                position: relative;
                background: #fff;
            }
            .details {
                height :40px;
                width: 340px;
            }
            .submit {
                background-image: none;
                padding: 8px 50px;
                margin-top:20px; 
                border-radius: 40px;
                border: 1px solid #25a08d;
                -webkit-transition: all ease 0.8s;
                -moz-transition: all ease 0.8s;
                transition: all ease 0.8s;
            }

        </style>
    </head>
        <body class="sign_up">
            <div class="container">
                <div class="top">
                    <h1>camagru</h1>
                    <hr/>
                    <h3>Sign up</h3>
                </div>
                <form class="sign_up"action="insert.php" method="post">
                    <p><input class="details" type="text" placeholder="username" name="name" required></p>
                    <p><input class="details" type="email" placeholder="e-mail" name="email" required></p>
                    <p><input class="details" type="password" placeholder="password" name="pwd" required></p>
                    <p><input class="details" type="password" placeholder="re_password" name="re_pwd" required></p>
                    <p><input class="submit" type="submit" name="signup" value="Register"></p>
                    <p>Already a member? <a href="login.php">Login!</a><p>
                </form>
            </div>
        </body>
</html>