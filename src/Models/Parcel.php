<?php

namespace MarkoSirec\GlsItaly\SDK\Models;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: The Parcel object
 */

/**
 * Class Parcel
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
final class Parcel extends BaseModel
{

    /**
     * The current status of the parcel.
     * Please look at the statuses class property for all the options
     *
     * @var string
     */
    private $status;

    /**
     * The parcel id provided by GLS Italy
     *
     * @var string
     */
    private $parcelId;

    /**
     * Name (+ lastname) on parcel (required)
     * Max length is 35 chars
     *
     * From the GLS documentation:
     *     RagioneSociale - Ragione sociale destinatario
     *
     * @var string
     */
    private $name;

    /**
     * Address (required)
     * Max length is 35 chars
     *
     * From the GLS documentation:
     *     Indirizzo - Indirizzo destinatario.
     *
     * @var string
     */
    private $address;

    /**
     * City (required)
     * Max length is 30 chars
     *
     * From the GLS documentation:
     *     Località - Località destinatario
     *
     * @var string
     */
    private $city;

    /**
     * Postcode (required)
     * Max length is 5 chars
     *
     * From the GLS documentation:
     *     Zipcode - Cap destinatario
     *
     * @var string
     */
    private $postcode;

    /**
     * Province 2 letter code (required)
     * Max length is 2 chars
     *
     * From the GLS documentation:
     *     Provincia - Provincia
     *
     * @var string
     */
    private $province;

    /**
     * Your order id. This field is required if you want to generate a PDF label.
     * Max length is 11 numbers
     *
     * From the GLS documentation:
     *     Bda - N° documento
     *
     * @var int
     */
    private $orderId;

    /**
     * Num of packages
     * Max length is 5 numbers
     *
     * From the GLS documentation:
     *     Colli - Numero colli della spedizione.
     *     NB: Nel metodo AddParcel è considerato sempre 1 collo
     *     (quindi in caso di N colli bisogna ripetere N volte
     *     il tag <Parcel>).
     *
     * @var int
     */
    private $numOfPackages = 1;

    /**
     * International Commercial Terms
     * Only if international shipment
     * Max length is 2
     *
     * From the GLS documentation:
     *     Incoterm - Solo se internazionale.
     *
     * @var int
     */
    private $incoterm;

    /**
     * Weight in kg (required)
     * Example: 0,70
     * Max length is 6 chars
     *
     * From the GLS documentation:
     *     PesoReale - Peso reale in Kg. (Es.: 12,5)
     *
     * @var string
     */
    private $weight;

    /**
     * The amount that needs to be payed upon delivery in EUR
     * For example 20,45
     * Max length is 10 chars
     *
     * From the GLS documentation:
     *     Importocontrassegno - Espresso in Euro. (Es. 123,1)
     *
     * @var string
     */
    private $paymentAmount;

    /**
     * Note displayed on label
     * Max length is 40
     *
     * From the GLS documentation:
     *     Notespedizione - Note visualizza sull'etichetta.
     *
     * @var string
     */
    private $noteOnLabel;

    /**
     * Type of port (?)
     * Allowed values: "F", "A"
     * Max length is 1 char
     *
     * From the GLS documentation:
     *     TipoPorto - F=Franco A=Assegnato
     *
     * @var string
     */
    private $portType;

    /**
     * The insurance amount in EUR
     * For example: 1,45
     * Max length is 11 chars
     *
     * From the GLS documentation:
     *     Assicurazione - Espresso in Euro. (Es. 123,1)
     *
     * @var float
     */
    private $insuranceAmount;

    /**
     * Volume weight (in kg.)
     * For example 20,45
     * Max length is 11
     *
     * From the GLS documentation:
     *     PesoVolume - Peso volume in Kg
     *
     * @var string
     */
    private $volumeWeight;

    /**
     * Any customer reference to be returned with the results
     * Max length is 600
     *
     * From the GLS documentation:
     *     RiferimentoCliente - Eventuali riferimenti cliente da
     *     restituire con gli esiti
     *
     * @var string
     */
    private $customerReference;

    /**
     * Note to be printed on "PDC"
     * Max length is 40
     *
     * From the GLS documentation:
     *     NoteAggiuntive - Eventuali note di consegna da
     *     stampare sulla PDC.
     *
     * @var string
     */
    private $pdcNote;

    /**
     * The customer id.
     * Max length is 30
     *
     * From the GLS documentation:
     *     CodiceClienteDestinatario - Eventuale codice del cliente presente in anagrafica.
     *     N.B. Nel caso sia specificato, la ricerca nell’anagrafica destinatari viene
     *     effettuata tramite il codice cliente e, non tramite (Ragione Sociale , Indirizzo,
     *     Località). Se la ricerca va a buon fine, vengono riportati i dati di instradamento
     *     presenti in anagrafica, non considerando quelli specificati nell XML.
     *
     * @var string
     */
    private $customerId;

    /**
     * The package type (0 = normal, 4 = plus)
     * Max length is 1
     *
     * From the GLS documentation:
     *     TipoCollo - 0 = Normale, 4 = Plus
     *
     * @var int
     */
    private $packageType = 0;

    /**
     * Comma separated list of emails
     * Max length is 70
     *
     * From the GLS documentation:
     *     Email - Indirizzi mail separati da virgola per invio di notifica
     *
     * @var string
     */
    private $email;

    /**
     * Primary mobile phone number
     * The number should be without the country code
     * and special characters (like +)
     * Max length is 10
     *
     * From the GLS documentation:
     *     Cellulare1 - N° cellulare x invio SMS di notifica
     *
     * @var string
     */
    private $primaryMobilePhoneNumber;

    /**
     * Secondary mobile phone number
     * The number should be without the country code
     * and special characters (like +)
     * Max length is 10
     *
     * From the GLS documentation:
     *     Cellulare2 - N° cellulare x invio SMS di notifica
     *
     * @var string
     */
    private $secondaryMobilePhoneNumber;

    /**
     * Comma separated list of additional services codes (max 6 codes)
     * For example: 01,06,09
     * Max length is 50
     *
     * From the GLS documentation:
     *     ServiziAccessori - Codici di 2 caratteri separati da virgola (Max.6)
     *     Esempio.: 01,06,09,14.
     *
     * @var string
     */
    private $additionalServices;

    /**
     * Abbreviated description of the payment method
     *
     * code | description
     * CONT | Cash
     * AC   | Cashier's check
     * AB   | Bank check
     * AP   | Postal check
     * ASS  | Postal / bank / circular post (?)
     * ABP  | Bank / post office
     * ASR  | (?)
     * ARM  | (?) Ass. As released int. Sender
     * ABC  | (?) Bank account / circular - no postal
     * ASRP | (?) Ass. As issued - no post
     * ARMP | (?) Ass. As released int. Sender - no postal
     *
     * Max length is 4
     *
     * From the GLS documentation:
     *     ModalitaIncasso - Descrizione abbreviata della modalità d’incasso
     *
     * @var string
     */
    private $paymentMethod;

    /**
     * The delivery date in YYMMDD format
     * For example: 190512
     * Max length is 6
     *
     * From the GLS documentation:
     *     DataPrenotazioneGDO - Data Prenotazione GDO (AAMMGG)
     *
     * @var string
     */
    private $deliveryDate;

    /**
     * Additional note for your custom delivery date
     * Max length is 40
     *
     * From the GLS documentation:
     *     OrarioNoteGDO - Note e/orario prenotazione GDO
     *
     * @var string
     */
    private $deliveryDateNote;

    /**
     * Label PDF format
     * A5 = A5 format
     * A6 = Format A6 (Default)
     * Max length is 2
     *
     * From the GLS documentation:
     *     FormatoPdf - Formato segnacolo in Pdf
     *
     * @var string
     */
    private $labelFormat;

    /**
     * Pin code for the IdentPIN service
     * Max length is 12
     *
     * From the GLS documentation:
     *     IdentPIN - Codice Pin per il servizio IdentPIN
     *
     * @var string
     */
    private $identPin;

    /**
     * Shipping insurance type
     * A = ALL-IN,
     * F = 10/10,
     * Empty = No supplementary insurance
     *
     * Max length is 1
     *
     * From the GLS documentation:
     *     AssicurazioneIntegrativa - A=ALL-IN, F=10/10,
     *     Vuoto= Nessuna assicurazione integrativa
     *
     * @var string
     */
    private $insuranceType;

    /**
     * Additional privacy text
     * Max length is 50
     *
     * @var string
     */
    private $additionalPrivacyText = 'Per info sul trattamento dati personali www.gls-italy.com/privacydest';

    /**
     * Enabling pickup point delivery provided by the GLS Italy DepotPickupService.
     * Link: https://gls-group.com/IT/it/spedire-ricevere/servizio-per-te/servizi-accessori/depotpickup.
     *
     * s = enable pickup point delivery.
     * Any other value or empty = option disabled.
     *
     * Max length is 1.
     *
     * From the GLS documentation:
     *     Se “s” allora attiva il calcolo del “Fermo Deposito” usando l’indirizzo
     *     specificato per identificare la sigla sede di Fermo Deposito
     *
     * @var string
     */
    private $pickUpDelivery;

    /**
     * The actual pickup point where recipient will get the parcel.
     * For this to work the $pickUp needs to be set to 's' ( enabled ).
     *
     * To get the identifier of the pickup point, you should use CheckAddress GLS Italy Service.
     * https://checkaddress.gls-italy.com/wscheckaddress.asmx
     *
     * Max length is 4.
     *
     * @var string
     *
     *  From the GLS documentation:
     *     I valori ammessi sono le sigle sedi GLS che fanno fermo deposito
     *    (verificare mediante metodo CheckDepotPickUp() )
     */
    private $pickUpPoint;

    /*
     * Shipment type (used for international shipments)
     *  P = Parcel
     *  N = National (default)
     *
     * Max length is 1
     *
     * @var string
     */
    private $shipmentType = 'N';

    /**
     * Reference person name (used for international shipments)
     *
     * Max length is 50
     *
     * @var string
     */
    private $referencePersonName = null;

    /**
     * Reference person phone number (used for international shipments)
     *
     * Max length is 16
     *
     * @var string
     */
    private $referencePersonPhoneNumber = null;

    /**
     * Status setter
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * Status getter
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * ParcelId setter
     * @param string $parcelId
     */
    public function setParcelId(string $parcelId): void
    {
        $this->parcelId = $parcelId;
    }

    /**
     * ParcelId getter
     * @return string
     */
    public function getParcelId(): string
    {
        return $this->parcelId;
    }

    /**
     * Name setter
     * @param string $value
     */
    public function setName(string $value): void
    {
        $this->name = $value;
    }

    /**
     * Name getter
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Address setter
     * @param string $value
     */
    public function setAddress(string $value): void
    {
        $this->address = $value;
    }

    /**
     * Address getter
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * City setter
     * @param string $value
     */
    public function setCity(string $value): void
    {
        $this->city = $value;
    }

    /**
     * City getter
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Postcode setter
     * @param string $value
     */
    public function setPostcode(string $value): void
    {
        $this->postcode = $value;
    }

    /**
     * Postcode getter
     * @return string|null
     */
    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    /**
     * Province setter
     * @param string $value
     */
    public function setProvince(string $value): void
    {
        $this->province = $value;
    }

    /**
     * Province getter
     * @return string
     */
    public function getProvince(): string
    {
        return $this->province;
    }

    /**
     * OrderId setter
     * @param int $value
     */
    public function setOrderId(int $value): void
    {
        $this->orderId = $value;
    }

    /**
     * ShipmentType setter
     * @param string $value
     */
    public function setShipmentType(string $value): void
    {
        $this->shipmentType = $value;
    }

    /**
     * OrderId getter
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * ShipmentType getter
     * @return string|null
     */
    public function getShipmentType(): ?string
    {
        return $this->shipmentType;
    }

    /**
     * NumOfPackages setter
     * @param int $value
     */
    public function setNumOfPackages(int $value): void
    {
        $this->numOfPackages = $value;
    }

    /**
     * NumOfPackages getter
     * @return int
     */
    public function getNumOfPackages(): int
    {
        return $this->numOfPackages;
    }

    /**
     * Incoterm setter
     * @param int $value
     */
    public function setIncoterm(int $value): void
    {
        $this->incoterm = $value;
    }

    /**
     * Incoterm getter
     * @return int|null
     */
    public function getIncoterm(): ?int
    {
        return $this->incoterm;
    }

    /**
     * Weight setter
     * @param string $value
     */
    public function setWeight(string $value): void
    {
        $this->weight = $value;
    }

    /**
     * Weight getter
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * PaymentAmount setter
     * @param string $value
     */
    public function setPaymentAmount(string $value): void
    {
        $this->paymentAmount = $value;
    }

    /**
     * PaymentAmount getter
     * @return string|null
     */
    public function getPaymentAmount(): ?string
    {
        return $this->paymentAmount;
    }

    /**
     * Note on label setter
     * @param string $value
     */
    public function setNoteOnLabel(string $value): void
    {
        $this->noteOnLabel = $value;
    }

    /**
     * Note on label getter
     * @return string|null
     */
    public function getNoteOnLabel(): ?string
    {
        return $this->noteOnLabel;
    }

    /**
     * Port type setter
     * @param string $value
     */
    public function setPortType(string $value): void
    {
        $this->portType = $value;
    }

    /**
     * Port type getter
     * @return string|null
     */
    public function getPortType(): ?string
    {
        return $this->portType;
    }

    /**
     * Insurance amount setter
     * @param string $value
     */
    public function setInsuranceAmount(string $value): void
    {
        $this->insuranceAmount = $value;
    }

    /**
     * Insurance amount getter
     * @return string|null
     */
    public function getInsuranceAmount(): ?string
    {
        return $this->insuranceAmount;
    }

    /**
     * Volume weight setter
     * @param string $value
     */
    public function setVolumeWeight(string $value): void
    {
        $this->volumeWeight = $value;
    }

    /**
     * Volume weight getter
     * @return string|null
     */
    public function getVolumeWeight(): ?string
    {
        return $this->volumeWeight;
    }

    /**
     * Customer reference setter
     * @param string $value
     */
    public function setCustomerReference(string $value): void
    {
        $this->customerReference = $value;
    }

    /**
     * Customer reference getter
     * @return string|null
     */
    public function getCustomerReference(): ?string
    {
        return $this->customerReference;
    }

    /**
     * Pdc note setter
     * @param string $value
     */
    public function setPdcNote(string $value): void
    {
        $this->pdcNote = $value;
    }

    /**
     * Pdc note getter
     * @return string|null
     */
    public function getPdcNote(): ?string
    {
        return $this->pdcNote;
    }

    /**
     * Customer id setter
     * @param string $value
     */
    public function setCustomerId(string $value): void
    {
        $this->customerId = $value;
    }

    /**
     * Customer id getter
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->customerId;
    }

    /**
     * Package type setter
     * @param int $value
     */
    public function setPackageType(int $value): void
    {
        $this->packageType = $value;
    }

    /**
     * Package type getter
     * @return int|null
     */
    public function getPackageType(): ?int
    {
        return $this->packageType;
    }

    /**
     * Email setter
     * @param string $value
     */
    public function setEmail(string $value): void
    {
        $this->email = $value;
    }

    /**
     * Email getter
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Primary mobile phone setter
     * @param string $value
     */
    public function setPrimaryMobilePhoneNumber(string $value): void
    {
        $this->primaryMobilePhoneNumber = $value;
    }

    /**
     * Primary mobile phone getter
     * @return string|null
     */
    public function getPrimaryMobilePhoneNumber(): ?string
    {
        return $this->primaryMobilePhoneNumber;
    }

    /**
     * Secondary phone setter
     * @param string $value
     */
    public function setSecondaryMobilePhoneNumber(string $value): void
    {
        $this->secondaryMobilePhoneNumber = $value;
    }

    /**
     * Secondary phone getter
     * @return string|null
     */
    public function getSecondaryMobilePhoneNumber(): ?string
    {
        return $this->secondaryMobilePhoneNumber;
    }

    /**
     * Additional services setter
     * @param string $value
     */
    public function setAdditionalServices(string $value): void
    {
        $this->additionalServices = $value;
    }

    /**
     * Additional services getter
     * @return string|null
     */
    public function getAdditionalServices(): ?string
    {
        return $this->additionalServices;
    }

    /**
     * Payment method setter
     * @param string $value
     */
    public function setPaymentMethod(string $value): void
    {
        $this->paymentMethod = $value;
    }

    /**
     * Payment method getter
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * Delivery date setter
     * @param string $value
     */
    public function setDeliveryDate(string $value): void
    {
        $this->deliveryDate = $value;
    }

    /**
     * Delivery date getter
     * @return string|null
     */
    public function getDeliveryDate(): ?string
    {
        return $this->deliveryDate;
    }

    /**
     * Delivery date noter setter
     * @param string $value
     */
    public function setDeliveryDateNote(string $value): void
    {
        $this->deliveryDateNote = $value;
    }

    /**
     * Delivery date note getter
     * @return string|null
     */
    public function getDeliveryDateNote(): ?string
    {
        return $this->deliveryDateNote;
    }

    /**
     * Pdf label format setter
     * @param string $value
     */
    public function setLabelFormat(string $value): void
    {
        $this->labelFormat = $value;
    }

    /**
     * Pdf label format getter
     * @return string|null
     */
    public function getLabelFormat(): ?string
    {
        return $this->labelFormat;
    }

    /**
     * IdentPin setter
     * @param string $value
     */
    public function setIdentPin(string $value): void
    {
        $this->identPin = $value;
    }

    /**
     * IdentPin getter
     * @return string|null
     */
    public function getIdentPin(): ?string
    {
        return $this->identPin;
    }

    /**
     * Insurance type setter
     * @param string $value
     */
    public function setInsuranceType(string $value): void
    {
        $this->insuranceType = $value;
    }

    /**
     * Insurance type getter
     * @return string|null
     */
    public function getInsuranceType(): ?string
    {
        return $this->insuranceType;
    }

    /**
     * Additional privacy text setter
     * @param string $value
     */
    public function setAdditionalPrivacyText(string $value): void
    {
        $this->additionalPrivacyText = $value;
    }

    /**
     * Additional privacy text getter
     * @return string|null
     */
    public function getAdditionalPrivacyText(): ?string
    {
        return $this->additionalPrivacyText;
    }

    /**
     * PickUpDelivery setter
     * @param string $value
     */
    public function setPickUpDelivery(string $value): void
    {
        $this->pickUpDelivery = $value;
    }

    /**
     * PickUpDelivery getter.
     * @return string|null
     */
    public function getPickUpDelivery(): ?string
    {
        return $this->pickUpDelivery;
    }

    /**
     * PickUpPoint setter
     * @param string $value
     */
    public function setPickUpPoint(string $value): void
    {
        $this->pickUpPoint = $value;
    }

    /**
     * PickUpPoint setter
     * @param string $value
     */
    public function getPickUpPoint(): ?string
    {
        return $this->pickUpPoint;
    }

    /**
     * Reference persona name needed for international shipments
     *
     * @return string
     */
    public function getReferencePersonName(): ?string
    {
        return $this->referencePersonName;
    }

    /**
     * Reference person name setter
     *
     * @param ?string $referencePersonName
     */
    public function setReferencePersonName(?string $referencePersonName): void
    {
        $this->referencePersonName = $referencePersonName;
    }

    /**
     * Reference person phone number
     *
     * @return string
     */
    public function getReferencePersonPhoneNumber(): ?string
    {
        return $this->referencePersonPhoneNumber;
    }

    /**
     * Reference person phone number setter
     *
     * @param ?string $referencePersonPhoneNumber
     */
    public function setReferencePersonPhoneNumber(?string $referencePersonPhoneNumber): void
    {
        $this->referencePersonPhoneNumber = $referencePersonPhoneNumber;
    }
}
