<?php
include 'config/db_conn.php';

$conn = getConnection();

if (isset($_POST['signup'])){
        
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $re_pwd = $_POST['re_pwd'];

    $query = $conn->prepare("SELECT COUNT(`users_id`) FROM `users` WHERE `username` = '$name'");

    $query->execute();
    $count = $query->fetchColumn();

    if ($count == "1"){
        echo "<script>alert('username already exist');window.location.href='signup.php';</script>"; 
    }
    else if (!preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/',$pwd)){
        echo "<script>alert('passwords format: Dkdjkfk#89');window.location.href='signup.php';</script>";
    }
    else if ($re_pwd != $pwd){
        echo "<script>alert('passwords must match');window.location.href='signup.php';</script>";
    }
    else{
            $confirmedcode = rand();
            $var = md5($pwd);
            $sql = "INSERT INTO users (username, email, pwd, confirmed, notify, confirmed_code)
            VALUES ('".$name."', '".$email."', '".$var."', '0', '1' , '".$confirmedcode."')";

            $message =
            "
                Confirm Your Email
                Click the link below to verify your account
                http://localhost:8080/camagru/confirm_email.php?username=$name&code=$confirmedcode
            ";

            mail($email, "camagru Confirm Email", $message, "From: DoNotReply@camagru.com");
           

            echo "  <div class='top-container'>
                        <h1>camagru</h1>
                        <h3>share your moments<h3>
                    </div>
                    <div class='container'>
                        <h1>Welcome!</h1>
                        <hr/>
                            <p> 
                                Registration Complite! </br>
                                Please check your email, we have send you a link for confirmation.  
                            </p>
                        <hr/>
                    </div>";

            // use exec() because no results are returned
            $conn->exec($sql);
            // echo "New record created successfully";
            // include 'login.php';
    }
}
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
        h1{
            text-align: center;
        }
        .top-container{
            /* margin: 0 auto;
            width: 60%; */
            text-align: center;
            background-color: #EF52CC;
            /* color: #ffffff; */
            padding: 15px;
        }
    </style>
</head>
<body>

</body>
</html>