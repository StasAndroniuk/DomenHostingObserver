<?php

if($_GET['id']!='')
    $o->DeleteRecorder($_GET['id']);
    $o->AddFormView();
  $recorders=$o->GetRecorderList();
  foreach ($recorders as $recorder) {
      $o->View($recorder);
  }
