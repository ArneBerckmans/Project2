<?php
spl_autoload_register(function($class){
    include_once ("classes/". $class . ".class.php");
});

try{
    if(!empty($_POST)){
        $email=$_POST['email'];
        $userName = $_POST['userName'];
        $passWord = $_POST['passWord'];
        $confirmPw = $_POST['confirm'];
        //$profileImg = $_POST['image'];


        $user = new User();
        $user->setEmail($email);
        $user->getUserName($userName);
        $user->setPassWord($passWord);

        /*if (!empty($passWord)){
        }*/

        if($_POST['passWord']!= $_POST['confirm']) {

            $error4 = "Wachtwoorden zijn niet matchend!";


        } else {
            if($user->save()){

                $userName = $_POST['userName'];
                $passWord = $_POST['passWord'];
                $user = new User();
                $user->setUserName($userName);
                $user->setPassWord($passWord);

                $user->login();

                header("Location: index.php");
            }
        }





    }

    if(!empty($_FILES) && isset($_POST['addPicture'])) {

        $file = $currentUser['userID'];

        $imageType = pathinfo(basename($_FILES["profile_picture"]["name"]), PATHINFO_EXTENSION);
        $targetFile = "uploads/profile_picture/" . $file . "." . $imageType;

        try {
            if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                throw new Exception('This is not an image');
            }

            if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFile)) {
                throw new Exception("Error uploading image");
            }

            $imageUrl = "uploads/profile_picture/".$currentUser['userID']. "." .$imageType;
            try{
                $user2 = new User();
                $user2->setEmail($currentUser['email']);
                $user2->setImageUrl($imageUrl);
                if ($user2->changeProfilePicture()){
                    $currentUser = $user->getProfile();
                    $feedback2 = "Saved";
                }
            }
            catch (Exception $e) {
                $error2 = $e->getMessage();
            }
        }
        catch (Exception $e){
            $error2 = $e->getMessage();
        }


    }
}
catch(Exception $e){

    $error = $e->getMessage();

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

    <legend>Registreer</legend>



    <!--<img id="blah" src="#" alt="jouw foto." />
    <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);">
    <input type="submit" value="Upload Image" name="submit">

<form action="upload.php" enctype="multipart/form-data" method="post">
    <img id="blah" src="#" alt="" />

    <input name="submit" type="submit" value="Upload">
</form>-->

    <form class="login addPicture" method="post" id="form1" runat="server" action="test.php" enctype="multipart/form-data">

        <img id="blah" src="#" alt="jouw foto." />
        <input type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);">


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
