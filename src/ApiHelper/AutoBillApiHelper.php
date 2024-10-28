<?php
namespace Api\ApiHelper;


use Api\ApiHelper\Communicator\Data\AutoBillApiRequestObject;

class AutoBillApiHelper
{

    private function getRequestType($requestObject)
    {
        if ($requestObject->is("get")) {
            return AutoBillApiSchemeHelper::GET;
        } elseif ($requestObject->is("post")) {
            return AutoBillApiSchemeHelper::POST;
        } elseif ($requestObject->is("delete")) {
            return AutoBillApiSchemeHelper::DELETE;
        }
    }

    public function processRequestInputAndHeader($requestObject)
    {
        $apiRequestObject = new AutoBillApiRequestObject();
        $apiRequestObject->httpMethod = $this->getRequestType($requestObject);
        if ($apiRequestObject->httpMethod === AutoBillApiSchemeHelper::GET) {
            $apiRequestObject->rawParams = $requestObject->getQueryParams();
        } elseif ($apiRequestObject->httpMethod === AutoBillApiSchemeHelper::POST || $apiRequestObject->httpMethod === AutoBillApiSchemeHelper::DELETE) {
            $apiRequestObject->rawParams = $requestObject->getData();
        }
        $apiRequestObject->contextType = $requestObject->getHeaderLine('Content-Type');
        return $apiRequestObject;
    }

}
