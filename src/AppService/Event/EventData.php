<?php
namespace Api\AppService\Event;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;


class EventData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }

    public function readAll()
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::EVENT, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetails($uuId)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::EVENT, AutoBillApiSchemeHelper::GET,$uuId);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function remove($uuId)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::EVENT, AutoBillApiSchemeHelper::POST,$uuId,null,'remove');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}
