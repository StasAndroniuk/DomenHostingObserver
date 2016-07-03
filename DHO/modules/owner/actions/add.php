<?php

$owner=$o->CheckOwnerData($_POST);
if($owner['is_error']==1)
{
    $o->DisplayError($owner['error_message']);
}
else
{
    $o->AddnewOwner($owner);
$owners = $o->GetOwnerList();
$o->AddFormView();
foreach ($owners as $owner) {
    $o->view($owner);
}
}



