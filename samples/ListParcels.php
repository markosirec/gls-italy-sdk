<?php

require '../vendor/autoload.php';

$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

$parcels = MarkoSirec\GlsItaly\SDK\Services\ParcelService::list($auth);
var_dump($parcels);