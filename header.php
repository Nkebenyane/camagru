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
  font-family: Arial, Helvetica, sans-serif;
}
h1 {
  position: absolute;
}

.header {
  text-align: center;
    overflow: hidden;
    /* background-color: #333; */
    top: 0;
    width: 100%;
  background-color: #f1f1f1;
  padding: 20px 10px;
  /* overflow: hidden; */
  /* position: fixed; */
  /* top: 0; */
  width: 100%;
}

 #a_header {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

 #a_header:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  #a_header {
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
  <h1>camagru</h1>
  <form method="post" name="logout">
      <div class="header-right">
        <a id="a_header" class="active" href="home.php?users_id=<?php echo $data['users_id'];?>">home |</a>
        <a id="a_header" href="gallery.php?users_id=<?php echo $data['users_id'];?>">gallery |</a>
        <a id="a_header" href="edit_pic.php?users_id=<?php echo $data['users_id'];?>">edit photos/stickes |</a>
        <a id="a_header" href="update.php?users_id=<?php echo $data['users_id']; ?>">edit profile |</a>
        <input id="a_header" type="submit" name="logout" value="Logout">
        <a id="a_header"><?php echo $_SESSION['username'];?></a>
      
      </div>
  </form>
</div>
</body>
</html>
