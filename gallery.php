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
    
    $name = $_SESSION['username'];

    $sql = "SELECT * FROM users WHERE username = '$name'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_GET['type'])){
        if (isset($_POST['comment_btn'])){
         $comment = $_POST['comment']; 
        
        $pictures_id = $_GET['pictures_id'];
      
        $type = $_GET['type'];
        switch($type){
            case 'comment':

            if ($result['notify'] == 1)
            {
                $email = $result['email'];
                $message = 
                                "
                                    Someone has commented on your picture
                                    Click the link below to to view the comment
                                    http://localhost:8080/camagru/confirm_email.php?username=$name
                                ";

                                mail($email, "camagru Confirm Email", $message, "From: DoNotReply@camagru.com");
            }
            
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
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>gallary</title>
<head>
   
    <style>
        /* The grid: Four equal columns that floats next to each other */


/* Style the images inside the grid */




/* Clear floats after the columns */

         
.comment {
    height: 70px;
    width: 90%;
    border-color: #333;
    border-radius: 10px,
    }

.btn {
  background-color: #ddd;
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 1;
  transition: 0.3s;
}
.submit {
                background-image: none;
                padding: 8px 50px;
                margin-top:20px; 
                border: 1px solid #25a08d;
                -webkit-transition: all ease 0.8s;
                -moz-transition: all ease 0.8s;
                transition: all ease 0.8s;
            }
.btn:hover {opacity: 0.6}
    </style>
</head>
<body>
    <br/>
    <div class="container">
  
        
                <strong>Gallery (like, comment an image) </strong>
            <hr/>
            <?php foreach($pictures as $img):?>
                <div class="row">
                    <div class="col-md-3">
                    <div class="thumbnail">
                        <h3><?php echo $img['users_name']; ?></h3>
                        <img src="uploads/<?php echo $img['pictures']?>" width="100%"><br>
                        <a href="like.php?type=picture&pictures_id=<?php echo $img['pictures_id']; ?>">Like</a>
                        <a href="like.php?type=delete&pictures_id=<?php echo $img['pictures_id']; ?>">Delete</a></br>
                        <?php if($img['likes'] == 0):?>
                            <?php echo $img['likes']?> like
                        <?php endif;?>
                        <?php if($img['likes'] == 1):?>
                            <?php echo $img['likes']?> like
                        <?php endif;?>
                        <?php if($img['likes'] > 1):?>
                            <?php echo $img['likes']?> likes
                        <?php endif;?>

                        <?php if(!empty($img['liked_by'])): ?>
                            
                                <?php foreach($img['liked_by'] as $user):?>
                                    <?php echo $user;?> | 
                                <?php endforeach; ?>
                            
                        <?php endif;?>
                            <form action="" method="post">
                                <a name="comment_btn" type="submit" href="gallery.php?type=comment&pictures_id=<?php echo $img['pictures_id']; ?>">comment</a>
                                <textarea class="comment" type="text" name="comment" placeholder="comment" required></textarea>
                                <br/>
                                <input class="submit" name="comment_btn" type="submit" value="Post"/>
                            </form>
                    
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