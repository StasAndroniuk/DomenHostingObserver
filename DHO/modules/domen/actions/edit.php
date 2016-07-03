<?php
 

$domen=$o->CheckDomenData($_POST);
$o->SaveDomen($domen);
$domen=$o->GetDomenById($domen['domen_id']);

$o->View($domen);