<?php
namespace Api\Component;

use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;
use Api\AppService\Account\AccountData;
use Api\AppService\Product\ProductData;

class ApiConfig
{
    private $authCredentialData;

    public function getAuthCredentialData()
    {
        return $this->authCredentialData;
    }

    public function __construct(AutoBillAuthCredentialData $authCredentialData)
    {
        $this->authCredentialData = $authCredentialData;
    }

    public function accountData() {
        return new AccountData($this);
    }

    public function productData() {
        return new ProductData($this);
    }

}
