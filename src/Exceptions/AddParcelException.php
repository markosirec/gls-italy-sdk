<?php

namespace MarkoSirec\GlsItaly\SDK\Exceptions;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: Exception thrown when an error happens in the add parcel service
 */

/**
 * Class AddParcelException
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
class AddParcelException extends BaseException
{
    private $xmlResponse;
    private $response;

    /**
     * XML response setter
     * @param \SimpleXMLElement $xmlResponse
     */
    public function setXmlResponse(\SimpleXMLElement $xmlResponse): void
    {
        $this->xmlResponse = $xmlResponse;
    }

    /**
     * XML response getter
     * @return \SimpleXMLElement
     */
    public function getXmlResponse(): \SimpleXMLElement
    {
        return $this->xmlResponse;
    }

    /**
     * Response setter
     * @param string $response
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }

    /**
     * Response getter
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }
}
