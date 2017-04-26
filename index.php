<?php


spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".class.php");
});

session_start();
if (!isset($_SESSION['login'])){
    header('location: logout.php');
}




?><!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Placeholder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

</head>
<body>
<header>
    <ul class="nav">
        <li><a class="profile" href="profile.php">Profile</a></li>
        <li><a class="logout" href="logout.php">Logout</a></li>
    </ul>
</header>


</body>
</html>