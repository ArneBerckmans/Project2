<?php
spl_autoload_register(function($class){
    include_once ("classes/". $class . ".class.php");
});

require_once 'dbconfig.php';

