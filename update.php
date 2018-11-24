<?php

include 'header.php';

if(isset($_GET['users_id'])){
    $id=$_GET['users_id'];
}

$showuser="SELECT * FROM users WHERE users_id=".$id;
$user=selectusers($showuser);

if (isset($_POST['submit'])){

$name = $_POST['username'];
$email = $_POST['email'];
$pwd = $_POST['pwd'];
$re_pwd = $_POST['re_pwd'];
$s_name = $_SESSION['username'];
    if (!empty($name)){

        $query="UPDATE users SET username= '".$name."' WHERE users_id= '$id'";
        $update=updateusers($query);

        if ($update == 0){
            echo "error in updating your name";
        }
        $query="UPDATE pictures SET users_name= '".$name."' WHERE users_name = '$s_name'";
        $update=updateusers($query);

        $query="UPDATE like_pic SET users_name= '".$name."' WHERE users_name = '$s_name'";
        $update=updateusers($query);

        $query="UPDATE comments SET users_name= '".$name."' WHERE users_name = '$s_name'";
        $update=updateusers($query);
    }
    if (!empty($email)){

        $query="UPDATE users SET email= '".$email."'";
        $update=updateusers($query);

        if ($update == 0){
            echo "error in updating your email";
        }
    }
   
    if (!empty($pwd)){
        if (!preg_match('/\A(?=[\x20-\x7E]*?[A-Z])(?=[\x20-\x7E]*?[a-z])(?=[\x20-\x7E]*?[0-9])[\x20-\x7E]{6,}\z/',$pwd)){
            echo $error = "passwords format incorrect: Dkdjkfk#89";
        }
        else if ($pwd == $re_pwd){
            $pwd = md5($pwd);
            $query="UPDATE users SET pwd= '".$pwd."'";
            $update=updateusers($query);
            if ($update == 0){
                echo "error in updating password";
            }
        }
        else {
            echo "password are no the same";
        }
    }
    echo $done = "updated successfully";
}

if (isset($_POST['delete'])){

    $sql = "DELETE FROM users WHERE users_id = '$id'";
    $update=updateusers($sql);

    if ($update != 0){
        echo "updated successfully";
    }
    else{
        echo "error in updating query";
    }
    header('location: signup.php');
}
if (isset($_POST['notify_off'])){

    $sql = "UPDATE users SET notify = '0' WHERE users_id = '$id'";
    $update=updateusers($sql);

    if ($update != 0){
        echo "comment notifications turned off";
    }
    else{
        echo "error in updating query";
    }
}
if (isset($_POST['notify_on'])){

    $sql = "UPDATE users SET notify = '1' WHERE users_id = '$id' ";
    $update=updateusers($sql);

    if ($update != 0){
        echo "comment notifications turned on ";
    }
    else{
        echo "error in updating query";
    }
}
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .top-container {
            width: 500px;
            height: 85%;
            padding: 40px;
            box-sizing: border-box;
            margin: 0 auto;
            height: 500px;
        }
        .info{
            width: 290px;
            height:40px;
            margin-left: 36%;
            margin-bottom: 4%;
        }
        label {
            height :40px;
            position: absolute;
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
    <br/>
    <div class="row">
    <div  class="top-container">
        <strong>Make changies in your profile</strong>
    <hr/>
    <br/>
        <form method="post">
            <label>Username :</label><input class="info" type="text" name="username" value="<?php echo $user['username'];?>">
            <label>email :</label><input class="info" type="email" name="email" value="<?php echo $user['email'];?>">
            <label>Password :</label><input class="info" type="password" name="pwd" Placeholder="Change Password">
            <label>Re_Password :</label><input class="info" type="password" name="re_pwd" Placeholder="Confirm Password">
            <input class="submit" type="submit" name="submit" value="Edit Profile">
            <input class="submit" type="submit" name="delete" value="Delete Profile">
            <br/>
            <br/>
            <hr/>
            <strong>comment notifications</strong><br/>
            <input class="submit" type="submit" name="notify_off" value="turn off">
            <input class="submit" type="submit" name="notify_on" value="turn on">
        </form>
    </div>
    </div>
    <br/>
    <br/>
    <div class="footer">
        <?php
            include 'footer.php';
        ?>
    </div>
</body>
</html>
