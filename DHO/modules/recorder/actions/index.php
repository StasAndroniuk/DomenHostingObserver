<?php

$recorders=$o->GetRecorderList();
$recorders[0]['first']=1;
$o->AddFormView();
foreach ($recorders as $recorder) {
    $o->View($recorder);
}
