<?php
/**
 * Created by PhpStorm.
 * User: Arne
 * Date: 30/05/2017
 * Time: 13:16
 */

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});

session_start();
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}

$user = new User();
$user->setUserName($_SESSION['user']);
$user->setEmail($_SESSION['user']);
$currentUser = $user->getProfile();
$userName = $user->getUserName();
$userID = $currentUser['userID'];
//$email = $currentUser['email'];
//echo $email;
//echo $userID; vind juiste ID

if (isset($_GET['saved'])) {
    $feedback = 'Wijzigingen opgeslagen';
}

if (!empty($_POST)){
    if (isset($_POST['editProfile'])){

       $newUserName = $_POST['userName'];
       $newPassWord = $_POST['password'];

       try{
           $email = $currentUser['email'];
           $updatedUser = new User();
           $updatedUser->setUserName($newUserName);

           if (!empty($_POST['password'])){
               $updatedUser->setPassWord($newPassWord);
           }

           if ($updatedUser->updateProfile($email)){
               $_SESSION['user'] = $email;
               $currentUser = $user->getProfile();
               $feedback = "Saved";
               $_SESSION['user'] = $updatedUser->getUserName();
               header('location: profile.php?saved');
           }
       }catch (Exception $e){
           $error = $e->getMessage();
       }



    }

    if (!empty($_FILES) && isset($_POST['editProfile'])) {
        $file = $currentUser['username'];

        $imageType = pathinfo(basename($_FILES["profilePics"]["name"]), PATHINFO_EXTENSION);
        $targetFile = "upload/profilePics/" . $file . "." . $imageType;

        try {
            if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                throw new Exception('Dit is geen afbeelding');
            }

            if (!move_uploaded_file($_FILES["profilePics"]["tmp_name"], $targetFile)) {
                throw new Exception("Error uploading image");
            }

            $profileImage = "upload/profilePics/".$currentUser['username'].".".$imageType;
            //echo $profileImage;
            try{
                $user2 = new User();
                $user2->setEmail($currentUser['email']);
                $user2->setProfileImage($profileImage);
                if ($user2->changePicture()){
                    $currentUser= $user->getProfile();
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


}



?><!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">
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
<header>
    <nav class="navbar">

        <img src="img/logo.png" class="logo" alt="logo">
        <div class="menu" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>
    <nav>
        <ul class="myDIV">
            <li><a class="profile" href="home.php">Home</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main class="profile2">

    <div class="info">
        <h1><?php echo htmlspecialchars($currentUser['username'])  ?></h1>
    </div>

<div class="edit">
    <form class="newProf editProfile" action="" method="post" enctype="multipart/form-data">

        <label for="profilePics">
            <img src="#" class="imageContainer profilePic" onchange="readURL(this);" style="background: url('<?php echo $currentUser["profileImage"] ?>') center; background-size: cover;">
        </label>
        <input type="file" style="display: none;"  name="profilePics" id="profilePics" onchange="readURL(this);" class="form-control hidden">

        <input type="button" value="Kies bestand" onclick="document.getElementById('profilePics').click();" />

        <div class="usernameEdit" id="input_container">
            <label for="userName">Nieuwe gebruikersnaam</label></br>
            <input type="text" name="userName" id="userName" class="passEdit" value="<?php echo htmlspecialchars($currentUser['username']); ?>">
            <img src="img/GebruikersnaamIcon.png" id="input_img">
        </div>

        <div id="input_container">
            <label for="password">Nieuw Wachtwoord</label></br>
            <input type="password" name="password" id="password" class="passEdit">
            <img src="img/SlotOpenIcon.png" id="input_img">
        </div>



        <input name="editProfile" class="save" type="submit" value="Aanpassen">

        <?php
        if (isset($error2)):?>
            <div class="alert alert-danger"><?php echo $error2; ?></div>
        <?php endif; ?>
        <?php
        if (isset($feedback2)):
            ?>
            <div class="alert alert-success"><?php echo $feedback2; ?></div>
        <?php endif; ?>


    </form>


</div>



</main>
<footer class="bottom">
    <a href="home.php" class="home2 footer clickable"><img src="img/home.png"></a>
    <a href="mood.php?id=$userID" class="circle footer2 clickable"><img src="img/new.png"></a>
    <a href="#" class="hist footer clickable"><img src="img/view.png"></a>
</footer>
</body>
</html>