<?php 

$owners=$o->getOwnerList();
$owners[0]['first']=1;

$o->AddFormView();
foreach ($owners as $owner) {
    $o->view($owner);
     
}