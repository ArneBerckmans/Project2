<?php

spl_autoload_register(function ($class) {
    include_once("classes/". $class . ".php");
});

    if(!empty($_POST)){
        if(!empty($_POST['userName']) && !empty($_POST['passWord'])){
            try{

                $userName = $_POST['userName'];
                $passWord = $_POST['passWord'];
                $user = new User();
                $user->setUserName($userName);
                $user->setpassWord($passWord);

                $user->login();
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        else{
            $error = "Vul je gegevens in!";
        }
    }


?><!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Quicksand" />

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</head>
<body>
    <div class="container">
        <form class="login" action="" method="post">

            <legend>Login</legend>

            <div id="input_container">
                <!--<label for="username">Gebruikersnaam</label>-->
                <input type="text" value="<?php echo(isset($_POST['userName']) ? $_POST['userName'] : ''); ?>" name="userName" id="username" class="form-control" placeholder="Gebruikersnaam">
                <img src="img/GebruikersnaamIcon.png" id="input_img">
            </div>

            <div id="input_container">
               <!--<label for="password">Paswoord</label>-->
                <input type="password" name="passWord" id="password" class="form-control" placeholder="paswoord">
                <img src="img/SlotOpenIcon.png" id="input_img">
            </div>

            <button class="btn" type="submit" >Login</button>
            <p>Nog geen acount? <a href="Register.php">Hier registreren!</a></p>


            <?php
            if (isset($error)): ?>

                <div class="alert"><?php echo $error ?></div>

            <?php endif; ?>

        </form>

    </div>
</body>
</html>