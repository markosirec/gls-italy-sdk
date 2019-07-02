# GLS Italy PHP SDK

This is an unofficial PHP SDK for the GLS Italy webservice. Since the official documentation and API are both in Italian, things can get quite confusing. Therefore I decided to create a simple library with which you can easily integrate your existing project with this webservice. Input params are validated, exceptions are thrown on errors, class properties and methods are properly documented, etc. etc.

Please note - GLS Italy has its own unique API and is very different from GLS branches in other countries.

## Getting Started

### Prerequisites

PHP 7.1
PHP curl library

### Installing

Clone/download this repo directly or get it through composer:

```
composer require markosirec/gls-italy-sdk
```

## Usage

### List parcels

Here is an example on how to get a list of all parcels in the GLS system for the current day:

```
$auth = new MarkoSirec\GlsItaly\SDK\Models\Auth();

$auth->setBranchId('your-branch-id');
$auth->setClientId('your-client-id');
$auth->setContractId('your-contract-id');
$auth->setPassword('your-password');

$parcels = MarkoSirec\GlsItaly\SDK\Services\ParcelService::list($auth);

```

### Add parcel and generate the PDF label/sticker

For a full list of options, take a look at the Parcel model in src/Models/Parcel.php

```
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

    // after a parcel has been added, the webservice needs you to confirm the shipping by calling the close endpoint. You can also do this later if you wish.
    MarkoSirec\GlsItaly\SDK\Services\ParcelService::close($auth, $parcel);
}

catch(Exception $e) {

    // get response error
    var_dump($e->getResponse());

    // get original response from GLS
    var_dump($e->getXml());
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

The library uses phpunit for tests. Cd into the library root folder and run:

```
vendor/bin/phpunit tests
```

## Contributing

Pull requests are very welcome. (Please use the PSR-2 coding style) This library does not yet support certain API features/endpoints so if you have a specific wish, please contact me and I will gladly help.

## Authors

- [Marko Širec](https://github.com/markosirec) - Initially created this Project

## Contact

- You can email me if you have questions or feature requests at m.sirec@gmail.com
- If you want to use German/Slovenian/Croatian, you are welcome to do so =)
- (sorry, I don't speak Italian though)

## License

This project is licensed under the MIT License.
