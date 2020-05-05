<?php

require '../vendor/autoload.php';

$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

$parcels = [];

$parcel = new MarkoSirec\GlsItaly\SDK\Models\Parcel();
$parcel->setName('John Smith');
$parcel->setAddress('Via su vrangone, 191');
$parcel->setCity('SOS ALINOS');
$parcel->setPostcode('08028');
$parcel->setProvince('NU');
$parcel->setWeight('2,7');
$parcel->setEmail('email@client.com');
$parcel->setOrderId(12345);
$parcels[] = $parcel;

$parcelsResponse = MarkoSirec\GlsItaly\SDK\Services\ParcelService::add($auth, $parcels);

foreach ($parcelsResponse as $parcel) {

    if (empty($parcel->getError())) {

        // this is your tracking code/id. I suggest you save it!
        $parcelId = $parcel->getParcelId();

        // generate the PDF
        file_put_contents(
            $parcelId.'.pdf', 
            base64_decode($parcel->getPdfLabel())
        );
    }
}

try {
    // After the parcels have been added, the webservice needs you to confirm the shipping by calling the close endpoint. 
    // You can also do this later if you wish. 
    // This is the equivalent of the "CloseWorkDay" endpoint. You need to supply the parcels you want to "close".
    MarkoSirec\GlsItaly\SDK\Services\ParcelService::close($auth, $parcels);
}

catch(Exception $e) {

    // get response error
    var_dump($e->getResponse());

    // get original response from GLS
    var_dump($e->getXml());
}