<?php


namespace Api\AppService\Invoice;


use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\Component\ApiConfig;

Class InvoiceData
{
    private $apiConfig;

    public function __construct(ApiConfig $apiConfig){
        $this->apiConfig=$apiConfig;
    }

    public function readALl(){
        $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try{
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e){
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readDetails($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readOrderInvoice($orderId)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::GET, $orderId, [], 'invoices');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createOrderInvoice($params ,$orderId)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ORDER, AutoBillApiSchemeHelper::POST, $orderId, $params, 'invoices');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function readDetailsInformation($id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::GET, $id, [], 'information');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAccountInvoices($accountID)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $accountID, [], 'invoices');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



    public function createAmend($params ,$id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::INVOICE, AutoBillApiSchemeHelper::POST, $id, $params, 'amend');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function delete($id){
        $requestBuilder= new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try{
            return $requestBuilder->callResource(ApiResource::INVOICE, AutoBillApiSchemeHelper::DELETE,$id);
        } catch (AutoBillApiException $e){
            throw new AutoBillApiException($e->getMessage());
        }
    }

}