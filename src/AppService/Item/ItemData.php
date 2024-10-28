<?php


namespace Api\AppService\Item;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;


class ItemData
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
            return $requestBuilder->callResource(ApiResource::ITEM, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetailsInformation($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $id,[],'information');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetailsSale($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $id,[],'sale');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetailsPurchase($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $id,[],'purchase');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetailsInventories($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::GET, $id,[],'inventories');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function create($params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ITEM, AutoBillApiSchemeHelper::POST,null,$params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function createSale($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::POST,$id,$params,'sale','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function createPurchaseWithoutSupplier($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::POST,$id,$params,'purchase','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function createPurchaseWithSupplier($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::POST,$id,$params,'purchase','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function update($id,$params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::PATCH,$id,$params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ITEM, AutoBillApiSchemeHelper::DELETE,$id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function reactivate($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::POST, $id,null,'reactivate','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function deactivate($id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ITEM, AutoBillApiSchemeHelper::POST,$id,null,'deactivate','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



}