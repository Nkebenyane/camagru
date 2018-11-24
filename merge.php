<?php

include 'config/db_conn.php';

$conn = getConnection();

       $id = $_GET['pictures_id'];
       $sql = "SELECT * FROM pictures WHERE pictures_id = '$id'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
       $result = $stmt->fetch(PDO::FETCH_ASSOC);

       $p1 = "uploads/".$result['pictures'];

       $p2 = "stickers/".$_GET['pic'];

       list($width, $height) = getimagesize($p2);

       $p1 = imagecreatefromstring(file_get_contents($p1));
       $p2 = imagecreatefromstring(file_get_contents($p2));

       imagecopy($p1, $p2, 20, 10, 0, 0, $width, $height);
       header('Content-Type: image/png');
       imagepng($p1);

       if (isset($_GET['save']) && $_GET['save'] == 1)
       {

           $str = "";
           $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
           $max = count($characters) - 1;
           $i = 0;
           while ($i < 10)
           {
               $rand = mt_rand(0, $max);
               $str = $str.$characters[$rand];
               $i++;
           }
           $str = $str.".png";
           $path = "/goinfre/mnkebeny/Desktop/MAMP/apache2/htdocs/camagru/uploads/".$str;
           imagepng($p1, $path);
           
           $sql = "INSERT INTO pictures (pictures, users_name) VALUES ('".$str."', '".$result['users_name']."')";
           $conn->exec($sql);
       }


?>