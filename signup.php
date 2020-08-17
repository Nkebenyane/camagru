<?php

?>
<!DOCTYPE <!DOCTYPE html>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<html>
    <head>
        <style>
         
            h1{
                text-align: center;
                padding: 0px 4px;
                font-family: Ropa Sans;
            font-weight: normal;
            font-size: 48px;
            line-height: 51px;
            text-align: center;
            font-style: italic;
            }
            h3 {
                text-align: center;
            }
            .container {
                max-width: 400px;
                margin: 2% auto 5%;
                padding: 15px;
                 /* margin: 0 auto; */
            /* width: 23%; */
            /* border: 1px solid #25a08d; */

                box-sizing: border-box;
                /* position: relative; */
                /* background: #FCF7FB;; */
            }
            .details {
                height :40px;
                width: 340px;
            }
            .submit {
                background-image: none;
                padding: 8px 50px;
                margin-top:20px; 
                border: 1px solid #25a08d;
                -webkit-transition: all ease 0.8s;
                -moz-transition: all ease 0.8s;
                transition: all ease 0.8s;
            }
            
        .top-container{
            /* margin: 0 auto;
            width: 60%; */
            text-align: center;
            background-color: #EF52CC;
            /* color: #ffffff; */
            padding: 15px;
        }
    a {
        text-decoration: none;
  
    
    }
        </style>
    </head>
    <body>
        <div class="top-container">
            <h1>camagru</h1>
            <h3>share your moments<h3>
        </div>
        <div class="container">
                <h3>Sign up</h3>
                <form class="sign_up"action="insert.php" method="post">
                    <p><input class="details" type="text" placeholder="username" name="name" required></p>
                    <p><input class="details" type="email" placeholder="e-mail" name="email" required></p>
                    <p><input class="details" type="password" placeholder="password" name="pwd" required></p>
                    <p><input class="details" type="password" placeholder="re_password" name="re_pwd" required></p>
                    <p><input class="submit" type="submit" name="signup" value="Register">
                    <a class="submit" href="Index.php">Cancel</a></p>
    
                    <p>Already a member? <a href="login.php">Login!</a><p>
                </form>
        </div>
        <div class="footer">
        <?php
            include 'footer.php';
        ?>
    </div>
    </body>
  
</html>