<?php

    session_start();

    $conn = new PDO('mysql:host=localhost;dbname=camagru','root', '');

    if (isset($_POST['submit'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
    
        $query = $conn->prepare("SELECT COUNT(`users_id`) FROM `users` WHERE `username` = '$name' AND `email` = '$email'");
    
        $query->execute();
        $count = $query->fetchColumn();
        if ($count == "1"){
           $message =
            "
                Reset your password
                Click the link below to reset your password
                http://localhost:8080/camagru/change_pwd.php?username=$name&email=$email
            ";

            mail($email, "camagru Confirm Email", $message, "From: DoNotReply@camagru.com");
            echo "Check your email to complite your process!";
            $conn->exec($sql);       
        }
        else{
            echo "<script>alert('user does not exist');window.location.href='forgot_password.php';</script>";
        }
     };
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>forgot_password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .container {
            margin: 0 auto;
            width: 700px;
        }
        form{
            max-width: 400px;
                margin: 2% auto 5%;
                padding: 40px;
                box-sizing: border-box;
                position: relative;
                background: #fff;
        }

        h1{
            text-align: center;
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
        <h1>Reset Password</h1>
        <hr/>
        <p>We can help you reset your password using your camagru
        username,or the email address linked to your account.</p>
        <hr/>
        <form method="post">
            <p>username: <input class="details" type="text" name="name" required></p>
            <p>email: <input class="details" type="text" name="email" required></p>
            <p><input class="submit" type="submit" name="submit" value="submit"/>
            <a class="submit" href="Index.php">Cancel</a>
            </p>
        </form>
    </div>
</body>
</html>