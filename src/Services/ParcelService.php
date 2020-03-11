<?php

namespace MarkoSirec\GlsItaly\SDK\Services;

use MarkoSirec\GlsItaly\SDK\Models\Auth as Auth;
use MarkoSirec\GlsItaly\SDK\Models\Parcel as Parcel;

use MarkoSirec\GlsItaly\SDK\Adapters\AuthAdapter as AuthAdapter;
use MarkoSirec\GlsItaly\SDK\Adapters\ParcelAdapter as ParcelAdapter;

use MarkoSirec\GlsItaly\SDK\Responses\AddParcelResponse as AddParcelResponse;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: Parcel services for listing, updating, adding, ... parcels
 */

/**
 * Class ParcelService
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
final class ParcelService extends BaseService
{
    /**
     * List the current parcels connected with the supplied Gls account
     * @param  Auth   $auth Instance of the Auth object
     * @return array        List of parcels
     */
    public static function list(Auth $auth): array
    {
        $authAdapter = new AuthAdapter($auth);
        $result = static::get('ListSped', (array)$authAdapter->get());
        return ParcelAdapter::parseListResponse($result);
    }

    /**
     * List the current parcels by status
     * @param  Auth   $auth     Instance of the Auth object
     * @param  String $status   - Null for all states
     *                          - 0 for parcels awaiting closure
     *                          - 1 for closed parcels 
     * @return array            List of parcels
     */
    public static function listByStatus(Auth $auth, String $status = ""): array
    {
        $authAdapter = new AuthAdapter($auth);
        $params = (array)$authAdapter->get();
        $params['Stato'] = $status;
        $result = static::get('ListSpedByStato', $params);
        return ParcelAdapter::parseListResponse($result);
    }

    /**
     * List parcels inside a timeframe. If "date from" is not specified, GLS will deduct 40 days
     * form "date to". If "date to" is not specified, then the current date is used.
     * Hours and minutes are optional.
     * @param  Auth   $auth     Instance of the Auth object
     * @param  String $dateFrom The format should be YYYYMMDDHHII (year-month-day-hour-minute) 
     * @param  String $dateTo   The format should be YYYYMMDDHHII (year-month-day-hour-minute) 
     * @return array            List of parcels
     */
    public static function listByPeriod(Auth $auth, String $dateFrom = "", String $dateTo = ""): array
    {
        $authAdapter = new AuthAdapter($auth);
        $params = (array)$authAdapter->get();
        $params['DataInizio'] = $dateFrom;
        $params['DataFine'] = $dateTo;
        $result = static::get('ListSpedPeriod', $params);
        return ParcelAdapter::parseListResponse($result);
    }

    /**
     * Adds a new parcel
     * @param Auth   $auth   Instance of the Auth object
     * @param Parcel $parcel Instance of the Parcel object
     * @return AddParcelResponse
     */
    public static function add(Auth $auth, Parcel $parcel): AddParcelResponse
    {
        $parcelAdapter = new ParcelAdapter($auth, $parcel);
        $authAdapter = new AuthAdapter($auth);

        $xmlData = [
            'Parcel' => (array)$parcelAdapter->get()
        ];

        $xmlData = array_merge((array)$authAdapter->get(), $xmlData);
        $xml = new \SimpleXMLElement('<Info/>');

        static::toXml($xml, $xmlData);
        $result = static::get('AddParcel', ['XMLInfoParcel' => $xml->asXML()]);

        return ParcelAdapter::parseAddResponse($result);
    }

    /**
     * Closes/finishes/commits a specific parcel
     * @param  Auth   $auth   Instance of the Auth object
     * @param  Parcel $parcel Instance of the Parcel object
     * @return bool           True on success
     */
    public static function close(Auth $auth, Parcel $parcel): bool
    {
        $parcelAdapter = new ParcelAdapter($auth, $parcel);
        $authAdapter = new AuthAdapter($auth);

        $xmlData = [
            'Parcel' => (array)$parcelAdapter->get()
        ];

        $xmlData = array_merge((array)$authAdapter->get(), $xmlData);
        $xml = new \SimpleXMLElement('<Info/>');

        static::toXml($xml, $xmlData);
        $result = static::get('CloseWorkDay', ['XMLCloseInfoParcel' => $xml->asXML()]);

        return ParcelAdapter::parseCloseResponse($result);
    }

    /**
     * Deletes a parcel
     * @param  Auth   $auth     Instance of the Auth object
     * @param  int    $parcelId Parcel id
     * @return bool             True on success
     */
    public static function delete(Auth $auth, int $parcelId): bool
    {
        $authAdapter = new AuthAdapter($auth);
        $data = array_merge((array)$authAdapter->get(), ['NumSpedizione' => $parcelId]);
        $result = static::get('DeleteSped', $data);

        return ParcelAdapter::parseDeleteResponse($result, $parcelId);
    }
}
