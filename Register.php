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


        $user = new User();
        $user->setEmail($email);
        $user->setUserName($userName);
        $user->setPassWord($passWord);

        /*if (!empty($passWord)){
        }*/

        if (empty($userName))
        {
            $error1= 'Vul dit veld in!';
        }

        if (empty($passWord))
        {
            $error2 = 'Vul dit veld in!';
        }

        if (empty($email))
        {

            $error3 = 'Vul dit veld in!';
        }
        if($_POST['passWord']!= $_POST['confirm']) {

            $error4 = "Wachtwoorden zijn niet matchend!";


        } else {

            if($user->save()){
                header("Location: index.php");
            }
            else{
                $error = "Woops";
            }

        }



        if (empty($userName))
        {
            $error1= 'Vul dit veld in!';
        }

        if (empty($passWord))
        {
            $error2 = 'Vul dit veld in!';
        }

        if (empty($email))
        {
            $error3 = 'Vul dit veld in!';
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

</head>
<body>
<div class="container">
    <form class="login" action="" method="post">

        <legend>Registreer</legend>

        


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

        <button class="btn" type="submit" >Registreer</button>
        <p>Al een account?</p>
        <a href="login.php">Hier inloggen!</a>

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