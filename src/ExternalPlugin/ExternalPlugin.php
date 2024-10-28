<?php
namespace Api\ExternalPlugin;

use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;

class ExternalPlugin
{
    private $authCredentialData;

    public function __construct(AutoBillAuthCredentialData $authCredentialData)
    {
        $this->authCredentialData = $authCredentialData;
    }

    public function getAuthCredentialData()
    {
        return $this->authCredentialData;
    }

    public function wiki(){
        return new Wiki($this);
    }
}
