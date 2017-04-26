<?php

spl_autoload_register(function($class){
    include_once ("classes/". $class . ".class.php");
});

session_start();
session_destroy();
header('location:login.php');