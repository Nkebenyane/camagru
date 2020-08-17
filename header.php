<?php

include 'config/db_conn.php';

session_start();

$query="SELECT * FROM users where username ='".$_SESSION['username'] ."' LIMIT 1";
$data=selectusers($query);
if (isset($_POST['logout'])){
    session_start();
    session_destroy();

    header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Ropa Sans;
}

.header {
  overflow: hidden;
  background-color: #EF52CC;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}
.logout_btn{
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  /* line-height: 25px; */
  /* border-radius: 4px; */
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover , button:hover {
  background-color: #752E65;
  color: white;
}

/* .header a.active {
  background-color: dodgerblue;
  color: white;
} */

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a,button {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}
</style>
</head>
<body>

<div class="header">
      <a href="#default" class="logo">camagru</a>
      <form method="post" name="logout">
          <div class="header-right">
            <a class="active" href="home.php?users_id=<?php echo $data['users_id'];?>">home |</a>
            <a href="gallery.php?users_id=<?php echo $data['users_id'];?>">gallery |</a>
            <a href="edit_pic.php?users_id=<?php echo $data['users_id'];?>">edit photos/stickes |</a>
            <a href="update.php?users_id=<?php echo $data['users_id']; ?>">edit profile |</a>
            <button class="logout_btn" type="submit" name="logout" value="Logout">Log out <i class="fa fa-sign-out"></i></button>
             <a id="a_header"><?php echo $_SESSION['username'];?></a>
          </div>
      </form>
</div>
</body>
</html>
