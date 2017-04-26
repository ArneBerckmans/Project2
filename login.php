<?php

spl_autoload_register(function($class){
    include_once ("classes/". $class . ".class.php");
});


?><!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
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

            <legend>Login</legend>

            <div>
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>

            <div>
               <label for="password">Paswoord</label>
                <input type="text" name="password" id="password" class="form-control">
            </div>

            <button class="btn" type="submit" >Login</button>
            <p>OR</p>
            <a href="register.php">Registreer</a>



        </form>

    </div>
</body>
</html>