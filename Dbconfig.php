<?php
/**
 * Created by PhpStorm.
 * User: Arne
 * Date: 26/03/2017
 * Time: 15:20
 */


$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "project2";

try
{
    $conn = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}


//include_once 'classes/User.class.php';
$user = new User($conn);