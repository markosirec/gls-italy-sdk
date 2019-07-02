<?php

require '../vendor/autoload.php';

$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

// this is the parcel id/tracking code you received from GLS when you added the parcel
$parcelId = 123;

// returns true on success, false on error
$result = MarkoSirec\GlsItaly\SDK\Services\ParcelService::delete($auth, $parcelId);