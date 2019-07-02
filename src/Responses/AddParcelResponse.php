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
    private $parcelId;
    private $pdfLabel;

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
}
