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
    <title>Welcome</title>
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
                      ui.find('.jcs').css({'border-color' : color });
                      ui.find('.jcs-indicator').css({'background' : color });
                      ui.find('.jcs-value ').css({'background' : color });
                      /*ui.next().css({
                          'background': 'linear-gradient(' + value +
                          'deg, white, cornsilk, white)'
                      });*/
                  }
              });
          });
      });



    </script>
</head>
<body>
<header>
    <nav class="navbar">

        <img src="#" alt="logo">
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

<div id="slider"></div>
<button class="moodReady">Ready</button>
</main>
<footer class="bottom">
    <a href="index.php" class="home footer clickable"><img src="#"></a>
    <a href="mood.php" class="moodLink circle footer clickable"><img src="#"></a>
    <a href="#" class="hist footer clickable"><img src="#"></a>
</footer>


</body>
</html>