<?php
$start = microtime(true); 
print_r('<pre>');
$owners= $o->GetownerList();
foreach ($owners as &$owner) {
   $owner['hostings']=$o->GetHostingForWarnings($owner['owner_id']);
   $owner['domens']=$o->GetDomenForWarnings($owner['owner_id']);
}


$o->SendEmails($owners);
echo microtime(true) - $start; 





