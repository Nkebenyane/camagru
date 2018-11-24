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
<html>
<head>
    <style>
        .top-container{
            margin: 0 auto;
            width: 60%;
            text-align: center;
            
        }
   
        .btn{
            border: 1px solid lightblue;
            border-radius: 4px;
        }
        .container_gallery{
                margin: 0 auto;
                width: 100%; 
            }
            .comment {
                height: 70px;
                width: 90%;
                border-color: #333;
                border-radius: 10px,
            }
            .col-sm-3{
            padding:20px;
            float:left;
            width:33.3%;
        }
    </style>
</head>
<body>
    <div class="top-container">
        <h1>camagru</h1>
        <h2>share your memories<h2>
        <form method="post">
            <input class="btn" type="submit" name="signup" value="Sign up">
            <input class="btn" type="submit" name="login" value="Log in">
        </form>
    </div>
    <div class="container">
    <br/>
    <div class="row">
        <div class="container_gallery">
                <strong>Gallery (like, comment an image) </strong>
            <hr/>
            <?php foreach($pictures as $img):?>
                    <div class="col-sm-3">
                        <h3><?php echo $img['users_name']; ?></h3>
                        <img src="uploads/<?php echo $img['pictures'] ?>" width="100%" height="300px"><br>
                        <?php if($img['likes'] == 1):?>
                            <p><?php echo $img['likes']?> like.</p>
                        <?php endif;?>
                        <?php if($img['likes'] > 1):?>
                            <p><?php echo $img['likes']?> likes.</p>
                        <?php endif;?>
                        <?php if(!empty($img['liked_by'])): ?>
                            <ul>
                                <?php foreach($img['liked_by'] as $user):?>
                                    <li><?php echo $user;?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif;?>
                         
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
            <?php endforeach; ?>
        </div>
    </div>
    </div>
</body>
</html>