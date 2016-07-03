<?php

$hosting=$o->GetCorrectedHosting($_POST);

$o->SaveHosting($hosting);
$hosting=$o->GetHostingById($hosting['hosting_id']);
$o->View($hosting);
