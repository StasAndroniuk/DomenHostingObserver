<?php


require_once('model/model.php');
require_once('controller/controller.php');

$o=new HostingController();


if($_GET['action']!='')
{
 
   require('actions/'.$_GET['action'].'.php');
}
   
else {
  require_once('actions/index.php');
}

 





?>