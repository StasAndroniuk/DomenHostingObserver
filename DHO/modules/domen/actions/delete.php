<?php

$o->DeleteDomen($_GET['id']);
$domens=$o->GetDomenList();
$o->AddFormView();
foreach ($domens as $domen) {
    $o->View($domen);
}