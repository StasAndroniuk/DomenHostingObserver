<?php

$recorder=$o->CheckRecorderData($_POST);
$o->AddRecorder($recorder);
$recorders=$o->GetRecorderList();
$o->AddFormView();
foreach ($recorders as $recorder) {
    $o->View($recorder);
}

