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


//posts ophalen

     $arrayUser = array();
     $arrayMood = array();

    $filter = new Post();
    $statementFilter = $filter->getAll();

/*    while ($row = $statementFilter->fetch(PDO::FETCH_ASSOC)){
        $arrayUser[] = $row['username'];
        $arrayMood[]= $row['moods'];
        //echo $arrayMood;
    }*/


/*$conn = db::getInstance();
$statementFilter = $conn->prepare("SELECT * FROM postsmoodi");
$statementFilter->execute();
$users = $statementFilter->fetchAll();
foreach ($users as $u){
    echo $u['moodID'];
}*/



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
<!--<header>
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
            <li><a class="profile" href="profile.php">Profile</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>-->
<main>

    <div class="filter">
        <button class="F1">Filter</button>
        <!--<p class="arrow-up"></p>-->
        <button class="F2 clickable2">Alles</button>
        <button class="F3 clickable2">Moodi</button> <!--PLACEHOLDER-->
        <button class="F4 clickable2">Instagram</button> <!--PLACEHOLDER-->
        <button class="F5 clickable2">Twitter</button> <!--PLACEHOLDER-->
    </div>


<div class="posts">
    <?php
       /* foreach ($arrayUser as $value){
            //echo $value;

        }
        foreach ($arrayMood as $moodValue){
            echo $moodValue;
        }*/

    while ($row = $statementFilter->fetch(PDO::FETCH_ASSOC)):
        $arrayUser[] = $row['username'];
        $arrayMood[]= $row['moods'];
        //echo $arrayMood;

    ?>
    <div class="usernames">
        <p><?php foreach ($arrayUser as $value){
                echo $value;
            } ?></p>
    </div>
    <div class="moods">
        <p><?php  foreach ($arrayMood as $moodValue){
                echo $moodValue;
            } ?></p>

    </div>


    <?php endwhile; ?>

</div>

</main>
<footer class="bottom">
    <a href="home.php" class="home2 footer clickable"><img src="#"></a>
    <a href="mood.php?id=$userID" class="circle footer2 clickable"><img src="#"></a>
    <a href="#" class="hist footer clickable"><img src="#"></a>
</footer>
</body>
</html>