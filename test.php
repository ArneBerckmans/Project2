<?php

spl_autoload_register(function($class){
    include_once ("classes/". $class . ".class.php");
});

require_once 'dbconfig.php';

if(isset($_POST['btnsave']))
{
    $username = $_POST['userName'];// user name
    $userjob = $_POST['email'];// user email
    $passWord = $_POST['passWord'];
    //$confirmPw = $_POST['confirm'];

    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];


    if(empty($username)){
        $errMSG = "Please Enter Username.";
    }
    else if(empty($userjob)){
        $errMSG = "Please Enter Your Job Work.";
    }
    else if(empty($imgFile)){
        $errMSG = "Please Select Image File.";
    }
    else if(empty($passWord)){
        $errMSG = "Please enter password";
    }
    else
    {
        $upload_dir = 'user_images/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $userpic = rand(1000,1000000).".".$imgExt;

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){
            // Check file size '5MB'
            if($imgSize < 5000000)    {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else{
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }


    // if no error occured, continue ....
    if(!isset($errMSG))
    {
        $stmt = $conn->prepare('INSERT INTO users(username,password, email, profileImage) VALUES(:uname, :pass, :email, :Pim)');
        $stmt->bindParam(':uname',$username);
        $stmt->bindParam(':email',$userjob);
        $stmt->bindParam(':pass',$passWord);
        $stmt->bindParam(':Pim',$userpic);

        if($stmt->execute())
        {
            $successMSG = "new record succesfully inserted ...";
            header("refresh:5;index.php"); // redirects image view page after 5 seconds.
        }
        else
        {
            $errMSG = "error while inserting....";
        }
    }
}

?><!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

    <script>
        function checkLength(passWord) {
            var password = document.getElementsByName(passWord);

            if (passWord.length < 6)
            {
                throw new Exception('paswoord is te kort!');
            }

        }

    </script>

</head>
<body>
<div class="container">



    <form class="login" method="post" id="form1" runat="server" action="upload.php" enctype="multipart/form-data">

        <legend>Registreer</legend>

        <input name="image" type="file"  onchange="readURL(this);">

        <div>
            <!--<label for="email">Email</label>-->
            <input value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>" type="text" name="email" id="email" class="form-control" placeholder="email">
        </div>

        <div>
            <!--<label for="username">Gebruikersnaam</label>-->
            <input value="<?php echo (isset($_POST['userName']) ? $_POST['userName'] : ''); ?>" type="text" name="userName" id="username" class="form-control" placeholder="Gebruikersnaam">
        </div>

        <div>
            <!--<label for="password">wachtwoord</label>-->
            <input value="<?php echo (isset($_POST['passWord']) ? $_POST['passWord'] : ''); ?>" type="password" name="passWord" id="password" class="form-control" placeholder="wachtwoord">
        </div>

        <div>
            <!--<label for="confirm">Bevestig wachtwoord</label>-->
            <input value="<?php echo(isset($_POST['confirm']) ? $_POST['confirm'] : ''); ?>" type="password" name="confirm" id="password" class="form-control" placeholder="Bevestig wachtwoord">
        </div>

        <button class="btn" type="submit" value="Upload" name="submit">Registreer</button>
        <p>Al een account? <a href="login.php">Hier inloggen!</a></p>


        <?php
        if (isset($error)): ?>
            <div class="alert"><?php echo $error ?></div>
        <?php endif; ?>
        <?php if(isset($error3)) { echo $error3; } ?>
        <?php if(isset($error1)) { echo $error1; } ?>
        <?php if(isset($error2)) { echo $error2; } ?>
        <?php if(isset($error4)) { echo $error4; } ?>

    </form>

</div>
</body>
</html>