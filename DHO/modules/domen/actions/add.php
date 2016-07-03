<?php

$o->AddDomen($_POST);
$domens=$o->GetDomenList();
$o->AddFormView();
foreach ($domens as $domen) {
    $o->View($domen);
}
