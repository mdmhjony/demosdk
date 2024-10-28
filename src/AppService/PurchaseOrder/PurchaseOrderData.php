<?php

namespace Api\AppService\PurchaseOrder;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;


class PurchaseOrderData
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
            return $requestBuilder->callResource(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetails($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetailsInformation($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],'information','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readLines($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],'lines','v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readLineDetails($id,$uuId){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute="lines/".$uuId;
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::GET, $id,[],$attribute,'v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAccountPurchaseOrders($accountId){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId,[],ApiResource::PURCHASE_ORDER,'v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function create($params){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::POST, null,$params,null,'v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::PURCHASE_ORDER, AutoBillApiSchemeHelper::DELETE, $id,[],null,'v3');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


}