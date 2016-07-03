<?php
session_start();

if(file_exists('install.php')==true)
{
    header("location: install.php");
    die();
}
require('config.php');
require('init.php');



?>