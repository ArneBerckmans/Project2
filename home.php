<?php

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});

session_start();
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}

    $user = new User();
    $user->setUserName($_SESSION['user']);
    $currentUser = $user->getProfile();
    $userName = $user->getUserName();
    $userID = $currentUser['userID'];
    //echo $userID; vind juiste ID

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
</head>
<body>
<header>
    <nav class="navbar">
    <!--<ul class="nav">
        <li><a class="profile" href="profile.php">Profile</a></li>
        <li><a class="logout" href="logout.php">Logout</a></li>
    </ul>-->
     <img src="img/logo.png" class="logo" alt="logo">
        <div class="menu" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>
    <nav>
        <ul class="myDIV">
            <li><a class="profile" href="profile.php">Profile</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>

    <div class="filter">
        <button class="F1">Filter</button>
        <!--<p class="arrow-up"></p>-->
        <button class="F2 clickable2">Alles</button>
        <button class="F3 clickable2">Moodi</button> <!--PLACEHOLDER-->
        <button class="F4 clickable2">Instagram</button> <!--PLACEHOLDER-->
        <button class="F5 clickable2">Twitter</button> <!--PLACEHOLDER-->
    </div>


</main>
<footer class="bottom">
    <a href="home.php.php" class="home footer clickable"><img src="#"></a>
    <a href="mood.php" class="circle footer clickable"><img src="#"></a>
    <a href="#" class="hist footer clickable"><img src="#"></a>
</footer>
</body>
</html>