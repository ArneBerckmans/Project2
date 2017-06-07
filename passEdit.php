<?php
/**
 * Created by PhpStorm.
 * User: Arne
 * Date: 30/05/2017
 * Time: 16:48
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

        <img src="img/logo.png" class="logo" alt="logo">
        <div class="menu" onclick="myFunction(this)">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
    </nav>
    <nav>
        <ul class="myDIV">
            <li><a class="profile" href="home.php">Back</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main class="profile2">



</main>
<footer class="bottom">
    <a href="home.php" class="home2 footer clickable"><img src="#"></a>
    <a href="mood.php?id=$userID" class="circle footer2 clickable"><img src="#"></a>
    <a href="#" class="hist footer clickable"><img src="#"></a>
</footer>
</body>
</html>