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
//echo $userID;

//Mood ophalen

        if(isset($_POST['ready'])){
            $mood = new post();
            $moodColor = $_POST['mood'];
            $statementMood = $mood->getMood($moodColor);

            while ($row = $statementMood->fetch(PDO::FETCH_ASSOC)){
                $moodChoice = $row['moodID'];
                //echo $moodID;
            }
            $moodID = $_GET['moodID'];
            $userID = $currentUser['userID'];
            $statementPost = $mood -> postMood();
            header('location: index.php');
        }


?><!doctype HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Kies je mood</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/circular-slider.min.css">

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/circular-slider.min.js"></script>

    <script>
      $( document ).ready(function() {
          //console.log("ready!");

          $(function () {
              var circularSlider = $('#slider').CircularSlider({
                  min: 0,
                  max: 359,
                  value: 0,
                  radius: 200,
                  labelSuffix: "°",
                  slide: function (ui, value) {
                      var colors = ['green', 'red', 'blue', 'yellow', 'pink', 'black'];
                      var color = colors[parseInt(value / 60)];
                      ui.find('.jcs').css({'border-color' : color, 'border-width': '50px' });
                      ui.find('.jcs-indicator').css({'background' : color});
                      ui.find('.jcs-value ').css({'background' : color, 'top': '15%', 'left': '17%' });
                      //document.getElementById('hiddenValue').value = value;
                      $('.data').val(color);

                  }
              });
              //window.location.href= "mood.php?uid=" .color;
          });
          function setInputValue(ui, val) {
              document.getElementById(slider).setAttribute('value', val);
          }
      });



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
            <li><a class="profile" href="profile.php">Profile</a></li>
            <li><a class="logout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<main>
<!--use form input to get data from java to php with get_request -->

    <div id="slider"></div>


    <form class="input" action="mood.php" method="post">
        <input id="hiddenValue" type="hidden" class="data" name="mood" value="">
        <button class="moodReady" type="submit" name="ready">Ready</button>
    </form>
</main>
<footer class="bottom">
    <a href="home.php" class="home footer clickable"><img src="#"></a>
    <a href="mood.php" class="moodLink circle footer clickable"><img src="#"></a>
    <a href="#" class="hist footer clickable"><img src="#"></a>
</footer>


</body>
</html>