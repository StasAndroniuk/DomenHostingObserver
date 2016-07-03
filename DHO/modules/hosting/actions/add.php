<?php

$hosting=$o->CheckHostingData($_POST);
$o->AddNewHosting($hosting);
require_once("index.php");