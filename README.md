# GLS Italy PHP SDK

This is an unofficial PHP SDK for the GLS Italy webservice. Since the official documentation and API are both in Italian, things can get quite confusing. Therefore I decided to create a simple SDK with which you can easily integrate your existing project.

Please note - GLS Italy has its own unique API and is very different from GLS branches in other countries.

## What's new

### v2.0.0

Adding and closing packets is now done in batches. You pass an array of Parcel instances instead of making a call for each individual parcel. (please have a look at the example below)

## Getting Started

### Prerequisites

- PHP 7.1
- PHP curl library

### Installing

Clone/download this repo directly or get it through composer:

```
composer require markosirec/gls-italy-sdk
```

## Usage

### List parcels

Here is an example of how to get a list of parcels in the GLS system. These endpoints can sometimes return weird or incomplete results - seems to be a bug in the GLS system. Keep in mind your mileage may vary!

```
$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

// List parcels for the last 40 days
$parcels = MarkoSirec\GlsItaly\SDK\Services\ParcelService::list($auth);

// List parcels by status (1 = closed parcels, 0 = waiting)
$parcels = MarkoSirec\GlsItaly\SDK\Services\ParcelService::listByStatus($auth, 1);

// List parcels by date/period (YYYYMMDD or YYYYMMDDHHII)
$parcels = MarkoSirec\GlsItaly\SDK\Services\ParcelService::listByPeriod($auth, "202001221300", "202001221700");

```

### Add parcels and generate the PDF label/sticker

For a full list of options, take a look at the Parcel model in src/Models/Parcel.php

```
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

$parcel = new MarkoSirec\GlsItaly\SDK\Models\Parcel();
$parcel->setName('Barbara Jordan');
$parcel->setAddress('Via Roma, 12');
$parcel->setCity('SOS ALINOS');
$parcel->setPostcode('08028');
$parcel->setProvince('NU');
$parcel->setWeight('2,1');
$parcel->setEmail('email2@client.com');
$parcel->setOrderId(12346);
$parcels[] = $parcel;

$result = MarkoSirec\GlsItaly\SDK\Services\ParcelService::add($auth, $parcels);

foreach ($result as $parcel) {

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
    // You can also do this later if you wish. This is the equivalent of the "CloseWorkDay" endpoint. 
    // You need to supply the parcels you want to "close".
    MarkoSirec\GlsItaly\SDK\Services\ParcelService::close($auth, $parcels);
}

catch(Exception $e) {

    // get response error
    var_dump($e->getResponse());

    // get original response from GLS
    var_dump($e->getXmlResponse());
}
```

### Delete parcel

```
$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

// this is the parcel id/tracking code you received from GLS when you added the parcel
$parcelId = 123;

// returns true on success, false on error
$result = MarkoSirec\GlsItaly\SDK\Services\ParcelService::delete($auth, $parcelId);
```

## Running the tests

The SDK uses phpunit for tests. Cd into the SDK root folder and run:

```
vendor/bin/phpunit tests
```

## Contributing

Pull requests are very welcome. (Please use the PSR-2 coding style) This library does not yet support certain API features/endpoints so if you have a specific wish, please contact me and I will try to help.

## Authors

- [Marko Širec](https://github.com/markosirec) - Initially created this Project

## Contact

- If you have questions or feature requests please email me at m.sirec@gmail.com
- (sorry, I don't speak Italian)

## License

This project is licensed under the MIT License.
