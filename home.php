<?php
    include 'header.php';

    
    if(isset($_POST['btn-add'])){

        $users_name = $_SESSION['username'];
        $images = $_FILES['profile']['name'];
        $tmp_dir = $_FILES['profile']['tmp_name'];
        $imageSize = $_FILES['profile']['size'];

        $upload_dir = 'uploads/';
        $imgExt = strtolower(pathinfo($images,PATHINFO_EXTENSION));
        $valid_extensions = array('jpej, jpg, png, gif, pdf,');
        $picProfile = rand(1000, 1000000).".".$imgExt;
        
        move_uploaded_file($tmp_dir, $upload_dir.$picProfile);
        $query = "INSERT INTO pictures (pictures, users_name) VALUE ('".$picProfile."','".$users_name."')";
        $update = updateusers($query);

        if ($update != 0)
        {
            header('location: home.php');
        }else{
            echo "<script>alert('Error while uploding');window.location.href='home.php';</script>";
        }
     }


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .btn {
            width:90px;
            height:90px;
            border-radius: 100px;
            margin:0 auto;
        }
        .row{
            width: 100%;
            height: 700px;
        }
        .col-sm-1{
            padding:20px;
            float:left;
            width:50%;
        }
        .col-sm-2{
            padding:20px;
            float:left;
            width:50%;
        }
       
        }
        @media screen and (max-width:800px) {
        .col-sm-1, .col-sm-2 {
            width:100%; /* The width is 100%, when the viewport is 800px or smaller */
            }
        }
        .holder{
            max-width:580px;
            height: 433px;
        }

        .fill{
            background-image: url("stickers/11.png");
            black url(/images/back.jpg) no-repeat top center fixed;
            -webkit-background-size: cover;
            background-size: cover;
            position: sticky;
            height: 150px;
            width: 150px;
            top: 5px;
            left: 5px;
            cursor: pointer;
        }
    
    #upload{
      background-image:url('') no-repeat top center fixed;
      black url(/images/back.jpg) no-repeat top center fixed;
    -webkit-background-size: cover;
    background-size: cover;
      display: inline-block;
      height: 440px;
      width: 486px;
      margin: 10px;
    }

    .empty{
      display: inline-block;
      height: 160px;
      width: 100%;
      margin: 10px;
    }
    
    .hold{
      border: solid #ccc 4px;
    }

    .hovered {
        background: #f4f4f4;
        border-style: dashed;
    }

    .invisible{
        display: none;
    }
    </style> 
</head>
<body>
<br/>
<div class="row">
    <!--left container-->
    <div class="col-sm-1">
    <!---------------------upload picture--------------------------------->
        <strong>take or upload a picture</strong>
        <hr/>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="profile" id="try_this" class="form-control" onchange="showImage.call(this)" accept=*/image>
            <button type="submit" name="btn-add">upload</button>
        </form>
            <script>
                function showImage()
                {
                    if (this.files && this.files[0])
                    {
                        var obj = new FileReader();
                        obj.onload = function(data){
                        var image = document.getElementById("image");
                        image.src = data.target.result;
                        image.style.display = "block";
                    }
                    obj.readAsDataURL(this.files[0]);
                }
            }

            </script>
            <br/>
            <br/>

    <!--------------------the webcam------------------------------------->
        <div class="video-container">
            <video id="video" style="width:100%">Stream not available!</video>
        </div>
        <br/>
        <div class="controllers" id="upload_2">
            <button id="photo-button" class="btn btn-dark">Take a pic</button>
            <button type="submit" class="btn btn-dark" id="save">Save</button>
        </div>
        <canvas id="canvas" style="display: none"></canvas>
    </div>

    <!-----------------middle container--------------------->
    <div class="col-sm-2">
        <strong>Captured picture</strong>
            <hr/>
        <!---upload amd webcam---->
        <div class="empty" id="upload">
            <div id="photos" style="width:100%"></div>
        </div>
        <br/>
    </div>
    <div class="footer">
        <?php
            include 'footer.php';
        ?>
    </div>
    
    <script src="js/try.js"></script>
    <script src="js/home.js"></script>
</body>
</html>