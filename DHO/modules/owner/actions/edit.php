<?php
session_start();
if($_SESSION['auth']!=1)exit();

$owner=$o->CheckOwnerData($_POST);
if($owner['is_error']==1)
{
  
  $o->DisplayError($owner['error_message']);
  
}
else
{
  $o->EditOwnerData($owner);
  $owner=$o->getOwnerById($owner['owner_id']); 
  $o->view($owner);
}
