<?php

spl_autoload_register(function($class){
    include_once ("classes/". $class . ".php");
});

    try{
        if (!empty($_POST)){
            $email = $_POST['email'];
            $userName = $_POST['userName'];
            $passWord = $_POST['passWord'];
            $confirm = $_POST['confirm'];

            $user = new User();
            $user->setEmail($email);
            $user->setUserName($userName);

            if (!empty($passWord)){
                $user->setpassWord($passWord);
            }

            if ($_POST['confirm'] != $_POST['passWord']){
                $error4 = "Wachtwoorden zijn niet matchend";
            }
            else{
               $user->save();
               header("Location: home.php");
                $user->login();
            }

        }
    }catch (Exception $e) {
        $error = $e->getMessage();
    }

if (!empty($_FILES) && isset($_POST['submit'])) {
    $file = $_POST['userName'];

    $imageType = pathinfo(basename($_FILES["profilePics"]["name"]), PATHINFO_EXTENSION);
    $targetFile = "upload/profilePics/" . $file . "." . $imageType;

    try {
        if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
            throw new Exception('Dit is geen afbeelding');
        }

        if (!move_uploaded_file($_FILES["profilePics"]["tmp_name"], $targetFile)) {
            throw new Exception("Error uploading image");
        }

        $profileImage = "upload/profilePics/".$_POST['userName'].".".$imageType;
        //echo $profileImage;
        try{
            $user2 = new User();
            $user2->setEmail($_POST['email']);
            $user2->setProfileImage($profileImage);
            if ($user2->changePicture()){
                //$currentUser= $user->getProfile();
                $feedback2 = "Saved";
                //echo $currentUser['profileImage'];
            }

        } catch (Exception $e) {
            $error2 = $e->getMessage();
        }


    } catch (Exception $e) {
        $error2 = $e->getMessage();

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


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.profilePic').attr('style', "background: url('"+e.target.result+"') center;background-size: cover;");
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</head>
<body>
<div class="container">


    <img src="img/LijnLogo.png" alt="logo" id="lijnlogo">
    <legend id="titelregistreren">Registreren</legend>


    <form class="login addPic addPicture" method="post" id="form1" runat="server" action="Register.php" enctype="multipart/form-data">

        <label for="profilePics">
            <img src="#" id="placeholder" class="imageContainer profilePic" onchange="readURL(this);" style="background: url('img/PlaceholderImage.png');  background-size: cover;" alt="image">
        </label>
        <input type="file" name="profilePics" style="display: none; " id="profilePics" onchange="readURL(this);" class="form-control" />
        <input type="button" id="bestand" value="Bestand kiezen" onclick="document.getElementById('profilePics').click();" />

        <?php
        if (isset($error2)):?>
            <div class="alert alert-danger"><?php echo $error2; ?></div>
        <?php endif; ?>
        <?php
        if (isset($feedback2)):
            ?>
            <div class="alert alert-success"><?php echo $feedback2; ?></div>
        <?php endif; ?>

        <div id="input_container">
            <!--<label for="username">Gebruikersnaam</label>-->
            <input value="<?php echo (isset($_POST['userName']) ? $_POST['userName'] : ''); ?>" type="text" name="userName" id="username" class="form-control" placeholder="Gebruikersnaam">
            <img src="img/GebruikersnaamIcon.png" id="input_img">
        </div>

        <div id="input_container">
            <!--<label for="email">Email</label>-->
            <input value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>" type="text" name="email" id="email" class="form-control" placeholder="E-mailadres">
            <img src="img/MailIcon.png" id="input_img">
        </div>


        <div id="input_container">
            <!--<label for="password">wachtwoord</label>-->
            <input value="<?php echo (isset($_POST['passWord']) ? $_POST['passWord'] : ''); ?>" type="password" name="passWord" id="password" class="form-control" placeholder="Wachtwoord">
            <img src="img/SlotOpenIcon.png" id="input_img">
        </div>

        <div id="input_container">
            <!--<label for="confirm">Bevestig wachtwoord</label>-->
            <input value="<?php echo(isset($_POST['confirm']) ? $_POST['confirm'] : ''); ?>" type="password" name="confirm" id="password" class="form-control" placeholder="Wachtwoord bevestigen">
            <img src="img/SlotClosedIcon.png" id="input_img">
        </div>

        <button class="btn editPic" type="submit" value="Upload" name="submit" id="registerbutton">Registreren</button>
        <p id="linkinloggen">Al een account? <a href="login.php">Hier inloggen!</a></p>


        <?php
        if (isset($error)): ?>
            <div class="alert"><?php echo $error ?></div>
        <?php endif; ?>
        <?php if(isset($error3)) { echo $error3; } ?>
        <?php if(isset($error1)) { echo $error1; } ?>
        <?php if(isset($error2)) { echo $error2; } ?>
        <?php if(isset($error4)) { echo $error4; } ?>

        </div>

</div>
</body>
</html>