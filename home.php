<?php

spl_autoload_register(function ($class) {
    //include_once("classes/" . $class . ".php");
    include_once ("classes/User.php");
    include_once ("classes/Post.php");
    include_once ("classes/Db.php");
});

require "library/twitteroauth.php";

include 'FootballData.php';

$consumer = "8OVw7s8sXLpmPL4KNcSiMpAwu";
$consumersecret = "A8gWPaV1Z9pE7HSvxwPZ56gmvZx0ilHPePqVJuHEGBIPitnvvP";
$accesstoken = "2839464083-Uw8zyamIEzdkEhIVo35PxZoSFVEapsAu5xAYZo5";
$accesstokensecret = "bmzkaxGKe3MfSJDZ8YmMco00ziFJrozRyKz2siMbtciX1";

$twitter = new TwitterOAuth($consumer, $consumersecret, $accesstoken, $accesstokensecret);

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


//twitter ophalen



/*echo $twitter->buildOauth($url, $requestMethod)
    ->setPostfields($postfields)
    ->performRequest();*/



//posts ophalen

     $arrayUser = "";
     $arrayMood = "";

    $filter = new Post();
    $statementFilter = $filter->getAll();

//filter

        if (isset($_POST['Moodi'])){
            $filter = new Post();
            $Mfilter = $filter->getMoodi();
        }

        if (isset($_POST['Inst'])){
            echo 'twitter';
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

    <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script>
        $( document ).ready(function() {

            $( ".F2" ).click(function() {
                $( ".actual" ).show();
                $( ".twitter" ).show();
            });

            $( ".F5" ).click(function() {
                $( ".actual" ).hide();
                $( ".twitter" ).show();
            });

            $( ".F3" ).click(function() {
                $( ".twitter" ).hide();
                $( ".actual" ).show();
            });
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
            <h1 id="titelinstellingen">Instellingen</h1>
            <li><a class="profile" href="profile.php">Profiel bewerken</a></li>
            <li><a class="passEdit" href="passEdit.php">Wachtwoord wijzigen</a></li>
            <li><a class="logout" href="logout.php">Uitloggen</a></li>
        </ul>
    </nav>
</header>

<main>




    <form method="post">
    <div class="filter">
        <button class="F1">Filter</button>
        <!--<p class="arrow-up"></p>-->
        <button type="button" class="F2 clickable2">Alles</button>
        <button type="button" class="F3 clickable2" name="Moodi"><img src="img/moodi.png"></button> <!--PLACEHOLDER-->
        <button type="button" class="F4 clickable2" name="Inst"><img src="img/instagram.png"></button> <!--PLACEHOLDER-->
        <button type="button" class="F5 clickable2" name="Twitter"><img src="img/twitter.png"></button> <!--PLACEHOLDER-->
    </div>
    </form>



<div class="posts">

    <div id="Instagram">
        <?php  /*function callInstagram($url)
        {
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 2
            ));

            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

        $tag = 'moodiKVM';
        $client_id = "3dedbbb0083248328b80781b5a8aa35e";
        $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;

        $inst_stream = callInstagram($url);
        $results = json_decode($inst_stream, true);

        foreach($results['data'] as $item){
            $image_link = $item['images']['low_resolution']['url'];
            echo '<img src="'.$image_link.'" />';
        }*/




        ?>


    </div>

    <div class="twitter">
        <form action="" method="post">
            <!--<label>Search: <input type="text" name="keyword"></label>-->
        </form>
        <?php
            $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=%23moodikvm&result_type=recent');
            $tweetsUser = $twitter->get('https://api.twitter.com/1.1/users/lookup.json');

        if(isset($tweets->statuses) && is_array($tweets->statuses)) {
            if(count($tweets->statuses)) {
                foreach($tweets->statuses as $tweet) {

                    echo '<div class="twitter2"><img src="'.$tweet->user->profile_image_url.'"/>'.$tweet->text.'<br></div>';

                }
            }
            else {

            }
        }
        ?>

    </div>

    <?php
       /* foreach ($arrayUser as $value){
            //echo $value;

        }
        foreach ($arrayMood as $moodValue){
            echo $moodValue;
        }*/

    while ($row = $statementFilter->fetch(PDO::FETCH_ASSOC)):
        $arrayUser = $row['username'];
        $arrayImage = $row['profileImage'];
        //$arrayMood= $row['moods'];
        $arrayMood= $row['color'];


        //echo $arrayMood;

    ?>
        <div class="actual">
    <div class="usernames">
        <img class="userimg" src="<?php echo $arrayImage; ?>" style="width: 50px; height: 50px; border-radius: 50px">
        <p class="username"><?php echo $arrayUser; ?></p>
    </div>
    <div class="moods">
        <p style="background-color: <?php echo $arrayMood; ?>; width: 50px; height: 50px; border-radius: 50px">
            <?php
            if($arrayMood == '#ed4850'){
                $moodImage = '<img style="width: 50px; height: 50px;" src="img/moods/mood0.png"';
                echo $moodImage;
            }
            elseif ($arrayMood == '#eaa149'){
                $moodImage = '<img style="width: 50px; height: 50px;" src="img/moods/mood1.png"';
                echo $moodImage;
            }
            elseif ($arrayMood == '#efe265'){
                $moodImage = '<img style="width: 50px; height: 50px;" src="img/moods/mood2.png"';
                echo $moodImage;
            }
            elseif ($arrayMood == '#6eea8b'){
                $moodImage = '<img style="width: 50px; height: 50px;" src="img/moods/mood3.png"';
                echo $moodImage;
            }
            elseif ($arrayMood == '#49c4ea'){
                $moodImage = '<img style="width: 50px; height: 50px;" src="img/moods/mood4.png"';
                echo $moodImage;
            }
            elseif ($arrayMood == '#ea49ea'){
                $moodImage = '<img style="width: 50px; height: 50px;" src="img/moods/mood5.png"';
                echo $moodImage;
            }

             ?>
        </p>

    </div>


</div>

    <?php endwhile; ?>



</div>

</main>

<footer class="bottom">
    <a href="home.php" class="home2 footer clickable"><img alt="home icon" id="homeIcon" src="img/home.png"></a>
    <a href="mood.php?id=$userID" class="circle footer2 clickable"><img alt="plus icon" id="plusIcon" src="img/new.png"></a>
    <a href="#" class="hist footer clickable"><img alt="beker icon" id="bekerIcon" src="img/view.png"></a>
</footer>

</body>
</html>