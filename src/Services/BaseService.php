<?php

namespace MarkoSirec\GlsItaly\SDK\Services;

use MarkoSirec\GlsItaly\SDK\Adapters\RequestData as RequestData;
use MarkoSirec\GlsItaly\SDK\Base as Base;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: The base service class
 */

/**
 * Class BaseService
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
class BaseService extends Base
{
    /**
     * The webservice url
     * @var string
     */
    const WEB_SERVICE_URL = 'https://labelservice.gls-italy.com/ilswebservice.asmx';

    /**
     * Main http/curl request method
     * @param  string $action      Gls endpoint
     * @param  array  $requestData POST data
     * @return string              The response string
     */
    protected static function get(string $action, array $requestData): string
    {
        $postData = http_build_query($requestData);

        $cr = curl_init();
        
        curl_setopt($cr, CURLOPT_URL, self::WEB_SERVICE_URL . '/' . $action);
        
        curl_setopt($cr, CURLOPT_POST, 1);
        curl_setopt($cr, CURLOPT_POSTFIELDS, $postData);
        
        curl_setopt($cr, CURLOPT_TIMEOUT, 3000);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        
        $headers = ['Content-Type: application/x-www-form-urlencoded', 'Content-Length: ' . strlen($postData)];
        
        curl_setopt($cr, CURLOPT_HEADER, false);
        curl_setopt($cr, CURLOPT_HTTPHEADER, $headers);
        
        return curl_exec($cr);
    }

    /**
     * Appends string data to SimpleXMLElement object
     * @param  \SimpleXMLElement $object
     * @param  array             $data
     */
    protected static function toXml(\SimpleXMLElement $object, array $data): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $newObject = $object->addChild($key);
                static::toXml($newObject, $value);
            } else {
                // if the key is an integer, it needs text with it to actually work.
                if ($key === (int)$key) {
                    $key = "key_$key";
                }
                
                $object->addChild($key, $value);
            }
        }
    }
}
