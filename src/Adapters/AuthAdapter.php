<?php

namespace MarkoSirec\GlsItaly\SDK\Adapters;

use MarkoSirec\GlsItaly\SDK\Models\Auth as Auth;
use MarkoSirec\GlsItaly\SDK\Exceptions\AuthException as AuthException;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: Adapter which transforms an Auth object to the format specified by GLS Italy
 */

/**
 * Class AuthAdapter
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
final class AuthAdapter extends BaseAdapter
{
    private $auth;

    /**
     * Class constructor
     * @param Auth $auth Instance of the Auth object
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Transforms auth data into a format specified by Gls
     * @return RequestData
     */
    public function get(): RequestData
    {
        $this->validateRequiredFields($this->auth);

        $requestData = new RequestData();

        $requestData->SedeGls = $this->formatStringForXml($this->auth->getBranchId(), 2);
        $requestData->CodiceClienteGls = $this->formatStringForXml($this->auth->getClientId(), 6);
        $requestData->PasswordClienteGls = $this->formatStringForXml($this->auth->getPassword(), 10);
        
        return $requestData;
    }

    /**
     * Validates the auth data
     * @param  Auth   $auth  The auth object
     * @throws AuthException in case required params are missing
     */
    private function validateRequiredFields(Auth $auth): void
    {
        if (empty($auth->getBranchId())) {
            throw new AuthException('Branch id in Auth object is missing.');
        } elseif (empty($auth->getClientId())) {
            throw new AuthException('Client id in Auth object is missing.');
        } elseif (empty($auth->getPassword())) {
            throw new AuthException('Password in Auth object is missing.');
        }
    }
}
