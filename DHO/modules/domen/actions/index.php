<?php
 
$domens=$o->GetDomenList();

$o->AddFormView();
$domens[0]['first']=1;

foreach ($domens as $domen) {
    $o->View($domen);
}
