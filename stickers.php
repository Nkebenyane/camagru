<?php
include 'header.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-sm-3{
            padding:20px;
            float:left;
            width:33.3%;
        }
        img{
            width:30%;
        }
    </style>
</head>
<body>

    <div class="col-sm-3">

        <a href="merge.php?pic=1.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/1.png" /></a>
        <a href="merge.php?pic=1.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>
    </div>
    <div class="col-sm-3">
        <a href="merge.php?pic=2.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/2.png"/></a>
        <a href="merge.php?pic=2.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>
    </div>
    <div class="col-sm-3">
        <a href="merge.php?pic=3.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/3.png"/></a>
        <a href="merge.php?pic=3.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>
    </div>
    <div class="col-sm-3">
         <a href="merge.php?pic=4.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/4.png"/></a>
        <a href="merge.php?pic=4.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>
    </div>
    <div class="col-sm-3">
         <a href="merge.php?pic=5.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/5.png"/></a>
        <a href="merge.php?pic=5.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>
    </div>
    <div class="col-sm-3">
        <a href="merge.php?pic=6.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/6.png"/></a>
        <a href="merge.php?pic=6.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>
    </div>
    <div class="col-sm-3">
         <a href="merge.php?pic=7.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/7.png"/></a>
        <a href="merge.php?pic=7.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>  
    </div>
    <div class="col-sm-3">
         <a href="merge.php?pic=8.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/8.png"/></a>
        <a href="merge.php?pic=8.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>  
    </div>
    <div class="col-sm-3">
         <a href="merge.php?pic=9.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/9.png"/></a>
        <a href="merge.php?pic=9.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>  
    </div>
    <div class="col-sm-3">
         <a href="merge.php?pic=10.png&save=0&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>"><img src="stickers/10.png"/></a>
        <a href="merge.php?pic=10.png&save=1&pictures_id=<?php echo $_id = $_GET['pictures_id']; ?>">save</a>  
    </div>

    <div class="footer">
        <?php
            include 'footer.php';
        ?>
    </div>
</body>
</html>