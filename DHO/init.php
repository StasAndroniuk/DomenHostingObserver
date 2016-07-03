<?php

//classes
require('classes/db_connection.php');

//modules

if($_SESSION['auth']==0)
require('modules/login/module.php');

else {
    require('modules/application/module.php');
   
}

?>