<?php

    include 'config/db_conn.php';

    $conn = getConnection();

    $username = $_GET['username'];
    $email = $_GET['email'];

    $emailquery = $conn->query("SELECT * FROM `users` WHERE `username` = '$username'");
    while ($row = $emailquery->fetch(PDO::FETCH_ASSOC)){
        
        $db_name = $row['name'];
    }

    $name = $_POST['name'];
    $pwd = $_POST['pwd'];
    $re_pwd = $_POST['re_pwd'];
    
    echo $username;
    
    if (isset($_POST['reset'])){
        
        if (!preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/',$pwd)){
            echo "<script>alert('passwords format: Dkdjkfk#89');window.location.href='signup.php';</script>";
        }
        else{
            $pwd = md5($pwd);
            $query = "UPDATE users SET pwd = '".$pwd."' WHERE username = '".$name."'";
            $update=updateusers($query);
            if ($update != 0){
                echo "account successfully";
            }
            else{
                echo "error in updating query";
            }
            $query->execute();
        }
    }
    header('location: reset_pwd.php');    
?>
