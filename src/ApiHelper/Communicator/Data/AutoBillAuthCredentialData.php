<?php
namespace Api\ApiHelper\Communicator\Data;

use Api\ApiHelper\Constant\AutoBillConstant;

class AutoBillAuthCredentialData
{
    private $apiUrl;
    private $appUrl;
    private $client_id;
    private $client_secret;
    private $access_token;
    private $refresh_token;
    private $redirect_uri;
    private $authTokenRenewCallback;

    public function __construct($params = [])
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }


    /**
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param mixed $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return mixed
     */
    public function getAppUrl()
    {
        return $this->appUrl;
    }

    /**
     * @param mixed $appUrl
     */
    public function setAppUrl($appUrl)
    {
        $this->appUrl = $appUrl;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * @param mixed $client_secret
     */
    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * @return mixed
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * @param mixed $refresh_token
     */
    public function setRefreshToken($refresh_token)
    {
        $this->refresh_token = $refresh_token;
    }

    /**
     * @return mixed
     */
    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    /**
     * @param mixed $redirect_uri
     */
    public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
    }

    /**
     * @return mixed
     */
    public function getAuthTokenRenewCallback()
    {
        return $this->authTokenRenewCallback;
    }

    /**
     * @param mixed $authTokenRenewCallback
     */
    public function setAuthTokenRenewCallback($authTokenRenewCallback)
    {
        $this->authTokenRenewCallback = $authTokenRenewCallback;
    }



}
