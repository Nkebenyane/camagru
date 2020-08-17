<?php
session_start();

include 'config/db_conn.php';

$conn = getConnection();

if (isset($_POST['login'])){
    
    $name = $_POST['name'];
    $pwd = $_POST['password'];

    $pass = md5($pwd);
    $query = $conn->prepare("SELECT COUNT(`users_id`) FROM `users` WHERE `username` = '$name' AND `pwd` = '$pass'");

    $query->execute();
    $count = $query->fetchColumn();
    
    
    $comquery = $conn->prepare("SELECT `confirmed` FROM `users` WHERE `username` = '$name' AND `pwd` = '$pass'");
    $comquery->execute();
    $com = $comquery->fetchColumn();
   
    if ($count == "1"){
        if ($com != '0'){
            $_SESSION['username'] = $name;
            header('location: home.php');
        }
        else{
            echo "<script>alert('You have to comfirm via an email sent to you, for you to log in');window.location.href='login.php';</script>";
        }
    }
    else if(empty($name && $pwd)){
        echo "<script>alert('Fill all fields');window.location.href='login.php';</script>";
    }
    else{
        echo "<script>alert('incorect username or password');window.location.href='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<html>
<head>
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="css/forms_style.css" /> -->
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
        <h3>Log in</h3>
        <form class="sign_up"name="login" method="post">
            <p><input class="details" type="text" placeholder="username" name="name" required></p>
            <p><input class="details" type="password" placeholder="password" name="password" required></p>
            <p><input class="submit" type="submit" name="login" value="Log in">
            <a class="submit" href="Index.php">Cancel</a></p>
            </p>
            <a href="forgot_password.php">Forgot password?</a>

            <p>need an account? <a href="signup.php">Register!</a><p>
        </form>
    </div>
    <div class="footer">
        <?php
            include 'footer.php';
        ?>
    </div>
</body>
</html>