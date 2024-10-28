<?php


namespace Api\ApiHelper\Config;


use Api\ApiHelper\Communicator\AutoBillApiCaller;
use Api\ApiHelper\Communicator\Data\AutoBillApiRequestData;
use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;

class ConfigManager
{


    /**
     * ConfigManager constructor.
     * @param $httpCommunicator
     */
    public function __construct()
    {
        $this->httpCommunicator = AutoBillApiCaller::getInstance();
    }


//    public function getFile() {
//        $fileName = "token.json";
//        $initialConfig = "{'apiUrl':'https://dev-api.autobill.com','appUrl':'https://dev-app.autobill.com','clientId':'','clientSecret':'','accessToken':'','refreshToken':'', 'redirectUrl':''}";
//
//        $getFile = file_get_contents($fileName);
//        $response = "";
//        if (!file_exists($getFile)) {
//            file_put_contents($fileName, $initialConfig);
//            $response = file_get_contents($fileName);
//        } else {
//            $response = file_get_contents($fileName);
//        }
//        return $response;
//    }



    public function getConfig() {
        $rootDir = dirname(__DIR__, 3);
        $publicPath = $rootDir . '/token.json';

        $getJsonObject = file_get_contents($publicPath);
        $jsonObject = json_decode($getJsonObject);

        $authCredential = new AutoBillAuthCredentialData([
            'apiUrl' => $jsonObject->apiUrl,
            'appUrl' => $jsonObject->appUrl,
            'client_id' => $jsonObject->client_id,
            'client_secret' => $jsonObject->client_secret,
            'access_token' => $jsonObject->access_token,
            'refresh_token' => $jsonObject->refresh_token,
            'redirect_uri' => $jsonObject->redirect_uri,
            'authTokenRenewCallback' => function($authCredentialData) use ($publicPath){
                file_put_contents($publicPath, json_encode((array) $authCredentialData));
            }
        ]);
        return $authCredential;

    }



    public function getAccessToken($apiUrl, $params= []){
        return $this->httpCommunicator->POST_JSON($apiUrl, $params);
    }

}



