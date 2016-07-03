<?php


require_once('model/model.php');
require_once('controller/controller.php');

$o=new CheckerController();


if($_GET['action']!='')
    require_once('actions/'.$_GET['action'].'.php');
else {
  require_once('actions/index.php');
}

 





?>