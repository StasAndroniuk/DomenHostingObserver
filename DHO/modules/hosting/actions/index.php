<?php

$hostings=$o->GetHostingList();
 $hostings[0]['first']=1;
$owners=$o->GetOwnerList();
$o->AddFormView($owners);

foreach ($hostings as $hosting) {
    $o->View($hosting);
}
