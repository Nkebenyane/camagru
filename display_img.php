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

 $comment = $_POST['comment'];
 $name = $_SESSION['username'];
//  $pic_id = $_SESSION['pictures_id'];

    if (isset($_POST['comment_btn'])){
    
        $sql = "INSERT INTO comments (users_name, comment)
                VALUES ('".$name."', '".$comment."')";
        $conn->exec($sql);
    };

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
</head>
<body>
    <?php foreach($pictures as $img):?>
        <div class="pic">
            <h3><?php echo $img['users_name']; ?></h3>
            <img src="uploads/<?php echo $img['pictures'] ?>" width="70%"><br>
            <a href="like.php?type=picture&pictures_id=<?php echo $img['pictures_id']; ?>">Like</a>
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
                <form action="" method="post">
                    <textarea type="text" name="comment" placeholder="comment"></textarea>
                    <br/>
                    <input type="submit" name="comment_btn" value="Post">
                </form>
        </div>
    <?php endforeach; ?>
    
</body>
</html>