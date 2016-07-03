<?php

$settings=$o->GetPostData($_POST);

$o->SaveSettings($settings);
require('index.php');