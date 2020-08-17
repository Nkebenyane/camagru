<?php
include 'header.php';

$conn = getConnection();

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

// echo '<pre>', print_r($pictures, true), '</pre>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
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
        img{
            width: 70%;
        }
    </style>
</head>
<body>
<br/>
    <div class="row">
        <div class="container_gallery">
                <strong>Edit your pictures (click on the picture to adit)</strong>
            <hr/>
            <?php foreach($pictures as $img):?>
            <div class="col-sm-3">
                <h3><?php echo $img['users_name']; ?></h3>
                <a href="stickers.php?pictures_id=<?php echo $img['pictures_id']; ?>"><img src="uploads/<?php echo $img['pictures'] ?>"></a><br>
                <!-- <a href="like.php?type=picture&pictures_id=<?php// echo $img['pictures_id']; ?>">Like</a> -->
                <?php if($img['likes'] == 0):?>
                    <?php echo $img['likes']?> like.
                <?php endif;?>
                <?php if($img['likes'] == 1):?>
                    <?php echo $img['likes']?> like.
                <?php endif;?>
                <?php if($img['likes'] > 1):?>
                    <?php echo $img['likes']?> likes.
                <?php endif;?>
                <?php if(!empty($img['liked_by'])): ?>
                    <!-- <ul> -->
                        <?php foreach($img['liked_by'] as $user):?>
                            <?php echo $user;?> |
                        <?php endforeach; ?>
                    <!-- </ul> -->
            
                <?php endif;?>
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