<?php

    include 'header.php';

    $conn = getConnection();

    $name = $_SESSION['username'];
    $sql = "SELECT * FROM pictures WHERE users_name = '$name'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['key']))
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
        // imagepng($p1, $path);
        
        file_put_contents($path, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '',$_POST['key'])));

        $sql = "INSERT INTO pictures (pictures, users_name) VALUES ('".$str."', '".$name."')";
        $conn->exec($sql);
    }
?>