<?php

namespace Api\AppService\Order;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;



class OrderData
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
            return $requestBuilder->callResource(ApiResource::ORDER, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readOrderLines($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $id,[],"lines");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetailsOrderLine($id, $chargeItemUUID){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute="lines/$chargeItemUUID";
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readInformation($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $id,[],"information");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAccountOrders($accountID){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $accountID,[],"billing-preferences");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function changeInformation($params, $id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::PATCH, $id,$params,"information");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function changeBillingPreferences($params, $id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::PATCH, $id,$params,"billing-preferences");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function updateBillingPreferences($params, $id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::PUT, $id,$params,"billing-preferences");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function changeOrderLineInformation($params, $id,$chargeItemUUID){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute="lines/$chargeItemUUID/information";
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::PATCH, $id,$params,$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function create($params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = "{ "."\"order\": " .$json." " ." }";
        $json = json_decode($json);
        try {
            return $requestBuilder->callResource(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, null, $json);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createOrderWithPurchase($params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, null, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function cancel($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $id, $json, 'cancel');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function orderByID($params, $id= null, $attribute= null)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $id, $json, $attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($id){
        $requestBuilder=new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ORDER, AutoBillApiSchemeHelper::DELETE,$id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function reactivate($params, $id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $id, $json, 'reactivate');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function change($params, $id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $id, $json, 'change');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function createWithFamilyType($params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ORDER, AutoBillApiSchemeHelper::POST,null,$params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function upgrade($id,$params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST,$id,$params,'upgrade');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function downgrade($id,$params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST,$id,$params,'downgrade');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function createOrderUsages($param)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($param);
        $json = json_decode($json);

        try {
            return $requestBuilder->callResource('usages',AutoBillApiSchemeHelper::POST, null, $json);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function upgradePreview($id,$params)
    {
        $attribute = "upgrade/preview";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST,$id,$params,$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function downgradePreview($id,$params)
    {
        $attribute = "downgrade/preview";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST,$id,$params,$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createExpress($params)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::EXPRESS,AutoBillApiSchemeHelper::POST, null, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function changePaymentMethod($params, $id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::PATCH, $id,$params,"information");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}
