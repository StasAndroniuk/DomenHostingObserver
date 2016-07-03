<?php

require_once('model/owner_model.php');
require_once('controller/controller.php');
require_once($_SERVER[DOCUMENT_ROOT].'/DHO/classes/validation.php');

$o=new ownerController();


if($_GET['action']!='')
 {
    require_once('actions/'.$_GET['action'].'.php');
 }  
else 
{
  require_once('actions/index.php');
}


?>