<?php

namespace MarkoSirec\GlsItaly\SDK\Models;

/**
 * Author: Marko Sirec [m.sirec@gmail.com]
 * Authors-Website: https://github.com/markosirec
 * Date: 27.06.2019
 * Version: 1.0.0
 *
 * Notes: Contains Auth data for making requests
 */

/**
 * Class Auth
 *
 * @package MarkoSirec\GlsItaly\SDK
 */
final class Auth extends BaseModel
{
    /**
     * The branch id (or "SedeGls"), for example "TS"
     * Max length is 2 chars
     * @var string
     */
    private $branchId;

    /**
     * Your client id (CodiceClienteGls)
     * Max length is 6 chars
     * @var int
     */
    private $clientId;

    /**
     * Your password
     * Max length is 10 chars
     * @var string
     */
    private $password;

    /**
     * Contract id
     * Max length is 6 chars
     * @var int
     */
    private $contractId;

    /**
     * BranchId setter
     * @param string $branchId
     */
    public function setBranchId(string $branchId): void
    {
        $this->branchId = $branchId;
    }

    /**
     * BranchId getter
     * @return string branchId
     */
    public function getBranchId(): ?string
    {
        return $this->branchId;
    }

    /**
     * ClientId setter
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * ClientId getter
     * @return string clientId
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * Password setter
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Password getter
     * @return string password
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * ContractId setter
     * @param int $contractId
     */
    public function setContractId(int $contractId): void
    {
        $this->contractId = $contractId;
    }

    /**
     * ContractId getter
     * @return int contractId
     */
    public function getContractId(): int
    {
        return $this->contractId;
    }
}
