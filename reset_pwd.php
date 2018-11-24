<?php
include 'config/db_conn.php';

$conn = getConnection();

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>change_pwd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
        .container {
            margin: 0 auto;
            width: 700px;
        }
        h1{
            text-align: center;
        }
        form {
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
<body>
<div class="container">
        <h1>Change Your Password</h1>
        <hr/>
        <form method="post" action="change_pwd.php">
            <p>Username: <input class="details" type="text" name="name" required></p>
            <p>New Password: <input class="details" type="text" name="pwd" required></p>
            <p>Re-Password: <input class="details" type="text" name="re_pwd" required></p>
            <p><input class="submit" type="submit" name="reset" value="Reset Password"/></p>
        </form>
    </div>
</body>
</html>