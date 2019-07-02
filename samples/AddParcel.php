<?php

require '../vendor/autoload.php';

$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

$parcel->setName('John Smith');
$parcel->setAddress('Via su vrangone, 191');
$parcel->setCity('SOS ALINOS');
$parcel->setPostcode('08028');
$parcel->setProvince('NU');
$parcel->setWeight('2,7');
$parcel->setEmail('email@client.com');
$parcel->setOrderId(12345);

try {
    $result = MarkoSirec\GlsItaly\SDK\Services\ParcelService::add($auth, $parcel);

    // generate the PDF
    file_put_contents(
        '/path/to/your.pdf', 
        base64_decode($result->getPdfLabel())
    );

    // this is your tracking code/id. I suggest you save it!
    $parcelId = $result->getParcelId();

    // after a parcel has been added, the webservice needs you to confirm the shipping by calling the close endpoint. 
    // You can also do this later if you wish.
    MarkoSirec\GlsItaly\SDK\Services\ParcelService::close($auth, $parcel);
}

catch(Exception $e) {

    // get response error
    var_dump($e->getResponse());

    // get original response from GLS
    var_dump($e->getXml());
}