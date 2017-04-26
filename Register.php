<?php

spl_autoload_register(function($class){
    include_once ("classes/". $class . ".class.php");
});

try{
    if(!empty($_POST)){
        $email=$_POST['email'];
        $userName = $_POST['userName'];
        $passWord = $_POST['passWord'];

        $user = new User();
        $user->setEmail($email);
        $user->setUserName($userName);

        if (!empty($passWord)){
            $user->setPassWord($passWord);
        }


        if($user->save()){
            header("Location: index.php");
        }
        else{
            $error = "Woops";
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

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</head>
<body>
<div class="container">
    <form class="login" action="" method="post">

        <legend>Registreer</legend>

        <div>
            <label for="email">Email</label>
            <input value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>" type="text" name="email" id="email" class="form-control">
            <?php if(isset($error3)) { echo $error3; } ?>
        </div>

        <div>
            <label for="username">Gebruikersnaam</label>
            <input value="<?php echo (isset($_POST['userName']) ? $_POST['userName'] : ''); ?>" type="text" name="userName" id="username" class="form-control">
            <?php if(isset($error1)) { echo $error1; } ?>
        </div>

        <div>
            <label for="password">Paswoord</label>
            <input value="<?php echo (isset($_POST['passWord']) ? $_POST['passWord'] : ''); ?>" type="text" name="passWord" id="password" class="form-control">
            <?php if(isset($error2)) { echo $error2; } ?>
        </div>

        <button class="btn" type="submit" >Registreer</button>
        <p>OR</p>
        <a href="login.php">Login</a>

        <?php
        if (isset($error)): ?>

            <div class="alert"><?php echo $error ?></div>

        <?php endif; ?>


    </form>

</div>
</body>
</html>