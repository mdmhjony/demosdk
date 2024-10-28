<?php
namespace Api\ApiHelper;

use Api\ApiHelper\Communicator\ApiResource;
use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;
use Api\ApiHelper\Communicator\AutoBillApiDataResolver;
use Api\AppService\AutoBillApiException;

class AutoBillRequestBuilder
{
    private $authCredentialData;
    public function __construct(AutoBillAuthCredentialData $authCredentialData)
    {
        $this->authCredentialData = $authCredentialData;
    }

    public function listAll($apiUrl, $max, $offset, $filter = []){
        $apiDataResolver = new AutoBillApiDataResolver();
        $requestToApiData = $apiDataResolver->getPostParamsData($apiUrl);
        $requestToApiData->setParamArray([
            "max" => $max,
            "offset" => $offset
        ]);
        return $apiDataResolver->requestToAPI($this->authCredentialData, $requestToApiData);
    }

    public function details($apiUrl, $itemUuid){
        $apiDataResolver = new AutoBillApiDataResolver();
        $requestToApiData = $apiDataResolver->getGetParamsData($apiUrl);
        $requestToApiData->setParamArray([
            "condition" => [
                "EQ" => [
                    "uuid" => $itemUuid
                ]
            ]
        ]);
        return $apiDataResolver->requestToAPI($this->authCredentialData, $requestToApiData);
    }

    public function customRequest($apiUrl, $requestMethod, $params = null){
        $apiDataResolver = new AutoBillApiDataResolver();
        switch ($requestMethod){
            case AutoBillApiSchemeHelper::GET:
                $requestToApiData = $apiDataResolver->getGetParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::POST:
                $requestToApiData = $apiDataResolver->getPostParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::DELETE:
                $requestToApiData = $apiDataResolver->getDeleteParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::PUT:
                $requestToApiData = $apiDataResolver->getPutParamsData($apiUrl);
                break;
            case AutoBillApiSchemeHelper::PATCH:
                $requestToApiData = $apiDataResolver->getPatchParamsData($apiUrl);
                break;
            default:
                throw new AutoBillApiException("Please specify a valid request method type. e.g: get / post / delete");
        }
        $requestToApiData->setParamArray($params);

        return $apiDataResolver->requestToAPI($this->authCredentialData, $requestToApiData);
    }


    public function callResource($apiResource, $requestMethod, $id = null, $params = []) {


        $path = "api/v2/" . $apiResource;

        if ($id != null) {
            $path = $path . '/' . $id;
        }

        if ($requestMethod == AutoBillApiSchemeHelper::PATCH ) {
            $path = $path . '/information';
        }



        try {
            return $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function callResourceInvoice($apiResource, $requestMethod, $id = null, $params = []){
        $path = "api/v2/".$apiResource;

        if ($id != null) {
            $path = $path.'/'.$id;
            if ($requestMethod == AutoBillApiSchemeHelper::POST || $requestMethod == AutoBillApiSchemeHelper::GET) {
                $path = $path.'/invoices';
            }
        }
        try {
            return  $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function callResourcePayment($apiResource, $requestMethod, $id = null, $params = []){
        $path = "api/v2/".$apiResource;

        if ($id != null) {
            $path = $path.'/'.$id;
            if ($requestMethod == AutoBillApiSchemeHelper::GET) {
                $path = $path.'/payments';
            }
        }
        try {
            return  $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    //attribute = cancel / activate /reactivate / Billing Preferences / payment
    public function callResourceAttribute($apiResource, $requestMethod, $id = null, $params = null, $attribute = null,$version=false){
        if($version){
            $path = "api/v3/".$apiResource;
        }else{
            $path = "api/v2/".$apiResource;
        }


        if ($id != null) {
            $path = $path.'/'.$id;
            if ($attribute != null) {
                $path = $path.'/'.$attribute;
            }
        }
        try {
            return  $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function callResourceAccountBillingPreferences($apiResource, $requestMethod, $id = null, $params = []){
        $path = "api/v1/".$apiResource;
        if ($id != null) {
            $path = $path.'/'.$id;
            if ($requestMethod == AutoBillApiSchemeHelper::GET || $requestMethod == AutoBillApiSchemeHelper::PUT ) {
                $path = $path.'/billing-preferences';
            }
        }
        try {
            return  $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function callResourceAccountPaymentMethod($apiResource, $requestMethod, $id = null, $params = []){
        $path = "api/v2/".$apiResource;
        if ($id != null) {
            $path = $path.'/'.$id;
            if ($requestMethod == AutoBillApiSchemeHelper::GET || $requestMethod == AutoBillApiSchemeHelper::PUT ) {
                $path = $path.'/payment-methods';
            }
        }
        try {
            return  $this->customRequest($path, $requestMethod, $params);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function callResourceByFilter($apiResource, $requestMethod, $email)
    {
        $path = "api/v1/" . $apiResource . '?filter=' . $apiResource . "/email_address%20eq%20'{$email}'";
        try {
            return  $this->customRequest($path, $requestMethod);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function callResourceByFilterProductName($apiResource, $requestMethod, $name)
    {
        $path = "api/v1/" . $apiResource . '?filter=' . $apiResource . "/name%20eq%20'{$name}'";
        try {
            return  $this->customRequest($path, $requestMethod);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function callResourceByFilterCustomAttribute($apiResource, $requestMethod, $attribute)
    {
        $path = "api/v1/" . $apiResource . '?filter=' . $apiResource . "/ca_product_attr_slug%20eq%20'{$attribute}'";
        try {
            return  $this->customRequest($path, $requestMethod);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



}
