<?php

$recorder=$o->CheckRecorderData($_POST);
$o->SaveChanges($recorder);
$recorder=$o->GetRecorderById($recorder['recorder_id']);
$o->View($recorder);