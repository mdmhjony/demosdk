<?php
namespace Api\ApiHelper\Communicator;

use Api\ApiHelper\AutoBillApiResponseUtil;
use Api\ApiHelper\Communicator\AutoBillApiCaller;
use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;
use Api\AppService\AutoBillApiException;
use Api\AppService\AutoBillUtil;
use Api\ApiHelper\Constant\AutoBillConstant;
use stdClass;

class AutoBillOAuth2ApiCaller
{

    private $httpCommunicator;
    private $authCredentialData;
    private $authenticationHeader = [];
    private $jsonDecodeArray;
    const REQUEST_AGAIN = "REQUEST_AGAIN";
    const TOKEN_RENEW_URL = "api/v1/oauth2/token";
    private $loop = 0;
    public $tokenRenewCallback = null;


    public function __construct(AutoBillAuthCredentialData $authCredentialData = null, $jsonDecodeArray = true)
    {
        $this->httpCommunicator = AutoBillApiCaller::getInstance();
        $this->authCredentialData = $authCredentialData;
        $this->tokenRenewCallback = $authCredentialData->getAuthTokenRenewCallback();
        $this->setAccessToken($authCredentialData->getAccessToken());
        $this->jsonDecodeArray = $jsonDecodeArray;
    }

    private function setAccessToken($accessToken){
        $this->authenticationHeader = ["Authorization: Bearer " . $accessToken];
    }

    private function setAccessTokenInHeader($headers = array()){
        if ($headers !== null){
            return array_merge($headers, $this->authenticationHeader);
        }else{
            return $this->authenticationHeader;
        }
    }

    public function getAccessToken() {
        try {

        $params = [
            "grant_type" => AutoBillConstant::GRANT_TYPE_CLIENT_CREDENTIALS,
            "client_id" => $this->authCredentialData->getClientId(),
            "client_secret" => $this->authCredentialData->getClientSecret(),
            "redirect_uri" => $this->authCredentialData->getRedirectUri(),
        ];

            $apiResponse = $this->httpCommunicator->POST_JSON($this->authCredentialData->getApiUrl().self::TOKEN_RENEW_URL, $params);
            if (isset($apiResponse['code']) && $apiResponse['code'] === 200 && isset($apiResponse['response'])) {
                $response = json_decode($apiResponse['response']);

                if (!empty($response->access_token)) {
                    $accessToken = [
                    'apiUrl' => $this->authCredentialData->getApiUrl(),
                    'appUrl' => $this->authCredentialData->getAppUrl(),
                    'client_id' => $this->authCredentialData->getClientId(),
                    'client_secret' => $this->authCredentialData->getClientSecret(),
                    "access_token" => $response->access_token,
                    "refresh_token" => $response->refresh_token,
                    'redirect_uri' => $this->authCredentialData->getRedirectUri(),
                    'authTokenRenewCallback' => $this->authCredentialData->getAuthTokenRenewCallback()
                    ];
                    $this->authCredentialData->setAccessToken($accessToken['access_token']);
                    $this->authCredentialData->setRefreshToken($accessToken['refresh_token']);
                    $this->setAccessToken($this->authCredentialData->getAccessToken());

                    call_user_func($this->tokenRenewCallback, $accessToken);

                }
             return true;
            } else {
                throw new AutoBillApiException(json_encode($apiResponse));
            }
        } catch (AutoBillApiException $appException) {
            throw new AutoBillApiException($appException->getMessage());
        }
    }



    private function renewAccessToken($statusCode)
    {
        try {
            $params = [
                "grant_type" => AutoBillConstant::GRANT_TYPE_REFRESH_TOKEN,
                "refresh_token" => $this->authCredentialData->getRefreshToken(),
                "client_id" => $this->authCredentialData->getClientId(),
                "client_secret" => $this->authCredentialData->getClientSecret(),
                "redirect_uri" => $this->authCredentialData->getRedirectUri()
            ];
            if ($statusCode === AutoBillApiResponseUtil::NOT_FOUND_SYSTEM_CODE){
                $params["grant_type"] = AutoBillConstant::GRANT_TYPE_AUTHORIZATION_CODE;
                $params["client_id"] = $this->authCredentialData->getClientId();
            }
            $apiResponse = $this->httpCommunicator->POST_JSON($this->authCredentialData->getApiUrl().self::TOKEN_RENEW_URL, $params);
            if (isset($apiResponse['code']) && $apiResponse['code'] === 200 && isset($apiResponse['response'])) {
                $json = json_decode($apiResponse['response'], true);
//                $responseData = AutoBillUtil::getValueWithException($json, "responseData", "Unable Get data from API");
//                $this->authCredentialData->setAccessToken(AutoBillUtil::getValueWithException($responseData, "access_token", "Unable Get data from API"));
//                $this->authCredentialData->setRefreshToken(AutoBillUtil::getValueWithException($responseData, "refresh_token", "Unable Get data from API"));
                $this->authCredentialData->setAccessToken($json['access_token']);
                $this->authCredentialData->setRefreshToken($json['refresh_token']);
                $this->setAccessToken($this->authCredentialData->getAccessToken());

                $paramsRefreshToken = [
                    'apiUrl' => $this->authCredentialData->getApiUrl(),
                    'appUrl' => $this->authCredentialData->getAppUrl(),
                    'client_id' => $this->authCredentialData->getClientId(),
                    'client_secret' => $this->authCredentialData->getClientSecret(),
                    'access_token' => $this->authCredentialData->getAccessToken(),
                    'refresh_token' => $this->authCredentialData->getRefreshToken(),
                    'redirect_uri' => $this->authCredentialData->getRedirectUri(),
                    'authTokenRenewCallback' => $this->authCredentialData->getAuthTokenRenewCallback()
                ];
                if ($this->tokenRenewCallback !== null){
                    call_user_func($this->tokenRenewCallback, $paramsRefreshToken);
                }
            }
            elseif (isset($apiResponse['code']) && $apiResponse['code'] === 400){
                $this->getAccessToken();
            }
            else {
                $requestResponse = new stdClass();
                $requestResponse->isSuccess = false;
                $requestResponse->statusCode = AutoBillApiResponseUtil::NOT_FOUND_SYSTEM_CODE;
                $responseDecode = json_decode($apiResponse['response']);
                $isSuccess = AutoBillUtil::getValue($responseDecode,'isSuccess');
                $statusCode = AutoBillUtil::getValue($responseDecode,'statusCode');
                $message = AutoBillUtil::getValue($responseDecode,'message');
                if(!is_null($isSuccess)) {
                    $requestResponse->isSuccess = $isSuccess;
                    $requestResponse->statusCode = $statusCode;
                    $requestResponse->message = $message;
                    $response = $requestResponse;
                }else{
                    $requestResponse->message = "Network Error";
                    $response = $requestResponse;
                }
                throw new AutoBillApiException(json_encode($response));
            }
        } catch (AutoBillApiException $appException) {
            throw new AutoBillApiException($appException->getMessage());
        }
    }

    private function responseProcessor($apiResponse){
        try {
            if (isset($apiResponse['code']) && in_array($apiResponse['code'], [200, 201, 202, 204]) && isset($apiResponse['response'])){
                $this->loop = 0;
                return json_decode($apiResponse['response'], $this->jsonDecodeArray);
            } else {
                if (isset($apiResponse['response'])) {
                    $requestResponse = new stdClass();
                    $responseDecode = json_decode($apiResponse['response']);
                    $isErrors = AutoBillUtil::getValue($responseDecode,'errors');
                    if (!is_null($isErrors)) {
                        if ($isErrors[0]->code == 401) {
                            if ($this->loop < 3) {
                                $this->loop++;
                                $this->renewAccessToken($isErrors[0]->code);
                                throw new AutoBillApiException(self::REQUEST_AGAIN);
                            } else {
                                throw new AutoBillApiException("Token renewal failed after 3 attempts.");
                            }
                        }
                        $requestResponse->error = $isErrors[0];
                    } else {
                        $requestResponse->message = "Network Error";
                    }
                    return $requestResponse;
                } else {
                    throw new AutoBillApiException($apiResponse);
                }
            }
        } catch (AutoBillApiException $appException) {
            throw new AutoBillApiException($appException->getMessage());
        }
    }


    public function DELETE_JSON($url, $params, $headers = array()){
        $headersWithToken = $this->setAccessTokenInHeader($headers);
        $response = $this->httpCommunicator->DELETE_JSON($url, $params, $headersWithToken);
        try {
            $response = $this->responseProcessor($response);
        } catch (AutoBillApiException $e) {
            if($e->getMessage() === self::REQUEST_AGAIN){
                $response = $this->DELETE_JSON($url, $params, $headers);
            }else{
                $response = json_decode($e->getMessage());
            }
        }
        return $response;
    }

    public function PUT_JSON($url, $params, $headers = array()){
        $headersWithToken = $this->setAccessTokenInHeader($headers);
        $response = $this->httpCommunicator->PUT_JSON($url, $params, $headersWithToken);
        try {
            $response = $this->responseProcessor($response);
        } catch (AutoBillApiException $e) {
            if($e->getMessage() === self::REQUEST_AGAIN){
                $response = $this->PUT_JSON($url, $params, $headers);
            }else{
                $response = json_decode($e->getMessage());
            }
        }
        return $response;
    }



    public function POST_JSON($url, $params, $headers = array()) {
        // Add the access token to the headers
        $headersWithToken = $this->setAccessTokenInHeader($headers);

        // Check if the request contains a file (or files)
        $hasFile = false;
        if($params!=null) {
            foreach ($params as $param) {
                if ($param instanceof \CURLFile || (is_array($param) && isset($param[0]) && $param[0] instanceof \CURLFile)) {
                    $hasFile = true;
                    break;
                }
            }
        }

        // If there's a file, send the request as multipart/form-data
        if ($hasFile) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);

            // Flatten the array to handle multiple files or nested arrays
            $flattenedParams = [];
            foreach ($params as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        $flattenedParams["{$key}[{$subKey}]"] = $subValue;
                    }
                } else {
                    $flattenedParams[$key] = $value;
                }
            }

            curl_setopt($ch, CURLOPT_POSTFIELDS, $flattenedParams);
            $headersWithToken[] = 'Content-Type: multipart/form-data';

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headersWithToken);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                curl_close($ch);
                throw new AutoBillApiException(curl_error($ch));
            }

            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($httpCode >= 400) {
                curl_close($ch);
                throw new AutoBillApiException('HTTP Error: ' . $httpCode . ' - ' . $response);
            }

            curl_close($ch);

            return $this->responseProcessor(['code' => $httpCode, 'response' => $response]);
        } else {
            // Handle the standard JSON POST request
            $response = $this->httpCommunicator->POST_JSON($url, $params, $headersWithToken);

            try {
                return $this->responseProcessor($response);
            } catch (AutoBillApiException $e) {
                if ($e->getMessage() === self::REQUEST_AGAIN) {
                    return $this->POST_JSON($url, $params, $headers);
                } else {
                    return json_decode($e->getMessage());
                }
            }
        }
    }




    public function PATCH_JSON($url, $params, $headers = array()){
        $headersWithToken = $this->setAccessTokenInHeader($headers);
        $response = $this->httpCommunicator->PATCH_JSON($url, $params, $headersWithToken);
        try {
            $response = $this->responseProcessor($response);
        } catch (AutoBillApiException $e) {
            if($e->getMessage() === self::REQUEST_AGAIN){
                $response = $this->PATCH_JSON($url, $params, $headers);
            }else{
                $response = json_decode($e->getMessage());
            }
        }
        return $response;
    }



    public function GET($url, $params = array(), $headers = array())
    {

        $headersWithToken = $this->setAccessTokenInHeader($headers);
        $response = $this->httpCommunicator->GET($url, $params, $headersWithToken);

        try {
            $response = $this->responseProcessor($response);

        } catch (AutoBillApiException $e) {
            if($e->getMessage() === self::REQUEST_AGAIN){
                $response = $this->GET($url, $params, $headers);
            }else{
                $response = json_decode($e->getMessage());
            }

        }
        return $response;
    }


}
