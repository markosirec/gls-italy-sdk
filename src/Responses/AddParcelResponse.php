<?php

namespace MarkoSirec\GlsItaly\SDK\Responses;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: Response object when a parcel is added
 */

/**
 * Class AddParcelResponse
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
final class AddParcelResponse extends BaseResponse
{
    private $parcelId, $pdfLabel, $zplLabel, $senderName, $volumeWeight, $shippingDate, $glsDestination, $csm, $areaCode;
    private $infoPrivacy, $receiverName, $address, $city, $province, $description1, $description2, $shippingWeight;
    private $shippingNotes, $transportType, $senderInitials, $progressiveParcel, $parcelType, $glsDestinationAbbr;
    private $printer, $totalPackages;

    /**
     * Parcel id setter
     * @param int $parcelId
     */
    public function setParcelId(int $parcelId): void
    {
        $this->parcelId = $parcelId;
    }

    /**
     * Parcel id getter
     * @return int
     */
    public function getParcelId(): int
    {
        return $this->parcelId;
    }

    /**
     * Pdf label setter
     * @param string $pdfLabel
     */
    public function setPdfLabel(string $pdfLabel): void
    {
        $this->pdfLabel = $pdfLabel;
    }

    /**
     * Pdf label getter
     * @return string
     */
    public function getPdfLabel(): string
    {
        return $this->pdfLabel;
    }

    /**
     * Zpl label setter
     * @param string $zplLabel
     */
    public function setZplLabel(string $zplLabel): void
    {
        $this->zplLabel = $zplLabel;
    }

    /**
     * Pdf label getter
     * @return string
     */
    public function getZplLabel(): string
    {
        return $this->zplLabel;
    }

    /**
     * Sender Name setter
     * @param string $senderName
     */
    public function setSenderName(string $senderName): void
    {
        $this->senderName = $senderName;
    }

    /**
     * Sender Name getter
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->senderName;
    }

    /**
     * Volume Weight setter
     * @param string $volumeWeight
     */
    public function setVolumeWeight(string $volumeWeight): void
    {
        $this->volumeWeight = $volumeWeight;
    }

    /**
     * Volume Weight getter
     * @return string
     */
    public function getVolumeWeight(): string
    {
        return $this->volumeWeight;
    }

    /**
     * Shipping Date setter
     * @param string $shippingDate
     */
    public function setShippingDate(string $shippingDate): void
    {
        $this->shippingDate = $shippingDate;
    }

    /**
     * Shipping Date getter
     * @return string
     */
    public function getShippingDate(): string
    {
        return $this->shippingDate;
    }

    /**
     * Gls Destination setter
     * @param string $glsDestination
     */
    public function setGlsDestination(string $glsDestination): void
    {
        $this->glsDestination = $glsDestination;
    }

    /**
     * Gls Destination getter
     * @return string
     */
    public function getGlsDestination(): string
    {
        return $this->glsDestination;
    }

    /**
     * CSM setter
     * @param string $csm
     */
    public function setCSM(string $csm): void
    {
        $this->csm = $csm;
    }

    /**
     * CSM getter
     * @return string
     */
    public function getCMS(): string
    {
        return $this->csm;
    }

    /**
     * Area Code setter
     * @param string $areaCode
     */
    public function setAreaCode(string $areaCode): void
    {
        $this->areaCode = $areaCode;
    }

    /**
     * Area Code  getter
     * @return string
     */
    public function getAreaCode(): string
    {
        return $this->areaCode;
    }

    /**
     * Info Privacy setter
     * @param string $infoPrivacy
     */
    public function setInfoPrivacy(string $infoPrivacy): void
    {
        $this->infoPrivacy = $infoPrivacy;
    }

    /**
     * Info Privacy getter
     * @return string
     */
    public function getInfoPrivacy(): string
    {
        return $this->infoPrivacy;
    }

    /**
     * Receiver Name setter
     * @param string $receiverName
     */
    public function setReceiverName(string $receiverName): void
    {
        $this->receiverName = $receiverName;
    }

    /**
     * Receiver Name getter
     * @return string
     */
    public function getReceiverName(): string
    {
        return $this->receiverName;
    }

    /**
     * Address setter
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
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
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
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
     * Province setter
     * @param string $province
     */
    public function setProvince(string $province): void
    {
        $this->province = $province;
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
     * Description 1 setter
     * @param string $description1
     */
    public function setDescription1(string $description1): void
    {
        $this->description1 = $description1;
    }

    /**
     * Description 1  getter
     * @return string
     */
    public function getDescription1(): string
    {
        return $this->description1;
    }

    /**
     * Description 2 setter
     * @param string $description2
     */
    public function setDescription2(string $description2): void
    {
        $this->description2 = $description2;
    }

    /**
     * Description 2 getter
     * @return string
     */
    public function getDescription2(): string
    {
        return $this->description2;
    }

    /**
     * Shipping Weight setter
     * @param string $shippingWeight
     */
    public function setShippingWeight(string $shippingWeight): void
    {
        $this->shippingWeight = $shippingWeight;
    }

    /**
     * Shipping Weight getter
     * @return string
     */
    public function getShippingWeight(): string
    {
        return $this->shippingWeight;
    }

    /**
     * Shipping Notes setter
     * @param string $shippingNotes
     */
    public function setShippingNotes(string $shippingNotes): void
    {
        $this->shippingNotes = $shippingNotes;
    }

    /**
     * Shipping Notes getter
     * @return string
     */
    public function getShippingNotes(): string
    {
        return $this->shippingNotes;
    }

    /**
     * Transport Type setter
     * @param string $transportType
     */
    public function setTransportType(string $transportType): void
    {
        $this->transportType = $transportType;
    }

    /**
     * Transport Type getter
     * @return string
     */
    public function getTransportType(): string
    {
        return $this->transportType;
    }

    /**
     * Sender Initials setter
     * @param string $senderInitials
     */
    public function setSenderInitials(string $senderInitials): void
    {
        $this->senderInitials = $senderInitials;
    }

    /**
     * Sender Initials getter
     * @return string
     */
    public function getSenderInitials(): string
    {
        return $this->senderInitials;
    }

    /**
     * Progressive Parcel setter
     * @param string $progressiveParcel
     */
    public function setProgressiveParcel(string $progressiveParcel): void
    {
        $this->progressiveParcel = $progressiveParcel;
    }

    /**
     * Progressive Parcel getter
     * @return string
     */
    public function getProgressiveParcel(): string
    {
        return $this->progressiveParcel;
    }

    /**
     * Parcel Type setter
     * @param string $parcelType
     */
    public function setParcelType(string $parcelType): void
    {
        $this->parcelType = $parcelType;
    }

    /**
     * Parcel Type getter
     * @return string
     */
    public function getParcelType(): string
    {
        return $this->parcelType;
    }

    /**
     * Gls Destination Abbreviation setter
     * @param string $glsDestinationAbbr
     */
    public function setGlsDestinationAbbr(string $glsDestinationAbbr): void
    {
        $this->glsDestinationAbbr = $glsDestinationAbbr;
    }

    /**
     * Gls Destination Abbreviation getter
     * @return string
     */
    public function getGlsDestinationAbbr(): string
    {
        return $this->glsDestinationAbbr;
    }

    /**
     * Printer setter
     * @param string $printer
     */
    public function setPrinter(string $printer): void
    {
        $this->printer = $printer;
    }

    /**
     * Printer getter
     * @return string
     */
    public function getPrinter(): string
    {
        return $this->printer;
    }

    /**
     * Total Packages setter
     * @param string $totalPackages
     */
    public function setTotalPackages(string $totalPackages): void
    {
        $this->totalPackages = $totalPackages;
    }

    /**
     * Total Packages getter
     * @return string
     */
    public function getTotalPackages(): string
    {
        return $this->totalPackages;
    }
}
