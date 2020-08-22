<?php
include_once 'config/database.php';
include_once 'config/setup.php';

if (isset($_POST['signup'])){
    header('location: signup.php');
}

if (isset($_POST['login'])){
    header('location: login.php');
}

$imgquery = $conn->query("
    SELECT 
    pictures.pictures_id, 
    pictures.users_name, 
    pictures.pictures,
    COUNT(like_pic.like_id) AS likes,
    GROUP_CONCAT(users.username SEPARATOR '|') AS liked_by

    FROM pictures

    LEFT JOIN like_pic
    ON pictures.pictures_id = like_pic.pictures_id

    LEFT JOIN users
    ON like_pic.users_name = users.username

    GROUP BY pictures_id 
    ");

while ($row=$imgquery->fetch(PDO::FETCH_ASSOC)){
    $row['liked_by'] = $row['liked_by'] ? explode('|', $row['liked_by']) : [];
    $pictures[] = $row;
}
  
    if (isset($_GET['type'])){
        if (isset($_POST['comment_btn'])){
         echo $comment = $_POST['comment']; 
        
        $pictures_id = $_GET['pictures_id'];
      
        $type = $_GET['type'];
        switch($type){
            case 'comment':
            
            $sql = "INSERT INTO comments (pictures_id,users_name, comment)
                VALUES ('".$pictures_id."','".$name."','".$comment."')";
                $conn->exec($sql);

        break;
        }
    }
       
    };
?>
<!DOCTYPE html>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Index</title>
<html>
<head>
    <style>


        .top-container{
            margin: 0 auto;
            /* width: 60%; */
            text-align: center;
            background-color: #EF52CC;
            /* color: #ffffff; */
            padding: 15px;
        }
        h1 {
            font-family: Ropa Sans;
            /* font-weight: normal; */
            font-size: 70px;
            line-height: 50px;
            text-align: center;
            /* font-style: italic; */
        }
        h3 {
            font-weight: normal;
        }
        .btn{
            /* border: 2px solid black; */
            background-color: white;
            color: black;
            padding: 14px 28px;
            font-size: 16px;
            cursor: pointer;
            border-color: white;
            color: #EF52CC;
        }
        .btn:hover {
            background-color: #EF52CC;
            color: white;
            }
   
    </style>
</head>
<body>
   
    <div class="top-container">
        <h1>camagru</h1>
        <h3>share your moments<h3>
        <form method="post">
            <input class="btn" type="submit" name="signup" value="  Sign up  "style="margin:15px;">
            <input class="btn" type="submit" name="login" value="   Log in   " style="margin:15px;">
        </form>
    </div>
    <div>
        <hr/>
    </div>
    <div class="container"> 
        <div class="row">
            
            <?php foreach($pictures as $img):?>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <h3><?php echo $img['users_name']; ?></h3>
                        <img src="uploads/<?php echo $img['pictures'] ?>"width="100%" height="350px"><br>
                        <?php if($img['likes'] == 0):?>
                            <p><?php echo $img['likes']?> like.</p>
                        <?php endif;?>
                        <?php if($img['likes'] == 1):?>
                            <p><?php echo $img['likes']?> like.</p>
                        <?php endif;?>
                        <?php if($img['likes'] > 1):?>
                            <p><?php echo $img['likes']?> likes.</p>
                        <?php endif;?>
                        <?php if(!empty($img['liked_by'])): ?>
                            <!-- <ul> -->
                                <?php foreach($img['liked_by'] as $user):?>
                                    <?php echo $user;?> |
                                <?php endforeach; ?>
                            <!-- </ul> -->
                        <?php endif;?>
                         <br/>
                        <strong>people's comments</strong>
                            <?php                                
                                $id = $img['pictures_id'];
                                $comquery = $conn->prepare("SELECT * FROM `comments` WHERE `pictures_id` = '$id'");
                                $comquery->execute();
                                while ($com = $comquery->fetch(PDO::FETCH_ASSOC)){

                                    ?>
                                        <ul>
                                            <li><?php echo $com['users_name']?></li>
                                            <p><?php echo $com['comment']?></p>
                                        </ul>
                                    <?php
                                }
                            ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="footer">
        <?php
            include 'footer.php';
        ?>
    </div>
</body>
</html>