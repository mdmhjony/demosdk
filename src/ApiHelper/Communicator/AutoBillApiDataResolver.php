<?php
namespace Api\ApiHelper\Communicator;

use Api\ApiHelper\Communicator\Data\AutoBillApiRequestData;
use stdClass;
use Api\ApiHelper\AutoBillApiHelper;
use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;

class AutoBillApiDataResolver
{

    public function requestToAPI(AutoBillAuthCredentialData $authCredentialData, AutoBillApiRequestData $apiRequestData){
        $apiResponse = null;
        $httpCommunication = new AutoBillOAuth2ApiCaller($authCredentialData);
        if ($apiRequestData->request !== null){
            $apiEngine = new AutoBillApiHelper();
            $apiRequestObject = $apiEngine->processRequestInputAndHeader($apiRequestData->request);
            $apiRequestData->params = $apiRequestObject->rawParams;
        }
        if ($apiRequestData->requestMethod ===  AutoBillApiSchemeHelper::POST){
            $apiResponse = $httpCommunication->POST_JSON($authCredentialData->getApiUrl() . $apiRequestData->url, $apiRequestData->params);
        }elseif ($apiRequestData->requestMethod ===  AutoBillApiSchemeHelper::DELETE){
            $apiResponse = $httpCommunication->DELETE_JSON($authCredentialData->getApiUrl() . $apiRequestData->url, $apiRequestData->params);
        }elseif ($apiRequestData->requestMethod ===  AutoBillApiSchemeHelper::PUT){
            $apiResponse = $httpCommunication->PUT_JSON($authCredentialData->getApiUrl() . $apiRequestData->url, $apiRequestData->params);
        }elseif ($apiRequestData->requestMethod ===  AutoBillApiSchemeHelper::PATCH){
            $apiResponse = $httpCommunication->PATCH_JSON($authCredentialData->getApiUrl() . $apiRequestData->url, $apiRequestData->params);
        }else{
            $apiResponse = $httpCommunication->GET($authCredentialData->getApiUrl() . $apiRequestData->url, $apiRequestData->params);
        }

        return $apiResponse;
    }

    public function getPostParamsData($url){
        return AutoBillApiRequestData::postRequestInstance($url);
    }

    public function getGetParamsData($url){
        return AutoBillApiRequestData::getRequestInstance($url);
    }

    public function getDeleteParamsData($url){
        return AutoBillApiRequestData::deleteRequestInstance($url);
    }

    public function getPutParamsData($url){
        return AutoBillApiRequestData::putRequestInstance($url);
    }

    public function getPatchParamsData($url){
        return AutoBillApiRequestData::patchRequestInstance($url);
    }
}
