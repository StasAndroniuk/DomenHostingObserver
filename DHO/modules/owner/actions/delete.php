<?
 $o->DeleteOwner($_GET['id']);
 $owners=$o->GetownerList();
 $o->AddFormView();
 foreach ($owners as $owner) {
    $o->view($owner);
 }
