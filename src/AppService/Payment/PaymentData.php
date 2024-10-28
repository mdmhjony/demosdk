<?php

namespace Api\AppService\Payment;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;


class PaymentData
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
            return $requestBuilder->callResource(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetails($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAccountPaymentDetails($accountId){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountId,[],'payments');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readOrderPaymentDetails($orderId){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId,[],'payments');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readInvoicePaymentDetails($invoiceId){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $invoiceId,[],'payments');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function createSinglePayment($invoiceId,$params){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST, $invoiceId,$params,'payments');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function delete($id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::PAYMENTS, AutoBillApiSchemeHelper::DELETE,$id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}