<?php
namespace Api\ApiHelper\Communicator;

use Api\ApiHelper\Communicator\Data\AutoBillAuthCredentialData;

class AutoBillApiCaller
{
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const HEAD = "HEAD";
    const DELETE = "DELETE";
    const PATCH = "PATCH";
    const APPLICATION_JSON_CONTEXT_TYPE = "application/json";
    const CONTEXT_TYPE = "Content-Type";
    public $reQuestTimeOut = 240;

    public function DELETE_JSON($url, $params, $headers = array()){
        $jsonHeader = [self::CONTEXT_TYPE . ":" . self:: APPLICATION_JSON_CONTEXT_TYPE];
        $headers = array_merge($jsonHeader, $headers);
        $params = json_encode($params);
        return $this->DELETE($url, null, $headers);
    }

    public function PUT_JSON($url, $params, $headers = array()){
        $jsonHeader = [self::CONTEXT_TYPE . ":" . self:: APPLICATION_JSON_CONTEXT_TYPE];
        $headers = array_merge($jsonHeader, $headers);
        $params = json_encode($params);
        return $this->PUT($url, $params, $headers);
    }

    public function PATCH_JSON($url, $params, $headers = array()){
        $jsonHeader = [self::CONTEXT_TYPE . ":" . self:: APPLICATION_JSON_CONTEXT_TYPE];
        $headers = array_merge($jsonHeader, $headers);
        $params = json_encode($params);
        return $this->PATCH($url, $params, $headers);
    }

    public function POST_JSON($url, $params=null, $headers = array())
    {
        $jsonHeader = [self::CONTEXT_TYPE . ":" . self:: APPLICATION_JSON_CONTEXT_TYPE];
        $headers = array_merge($jsonHeader, $headers);
        $params = json_encode($params);
        if(empty($params)){
            $params=null;
        }
        return $this->POST($url, $params, $headers);
    }

    public function GET($url, $params = array(), $headers = null)
    {
//        var_dump($params);
//        die("p");
//
        if (count($params) !== 0) {
            $params = http_build_query($params);
        } else {
            $params = null;
        }
        return $this->makeCurlCall($url, self::GET, null, $params, $headers);
    }

    public function POST($url, $params, $headers = null){
        return $this->makeCurlCall($url, self::POST, $params, null, $headers);
    }

    public function DELETE($url, $params =null, $headers = null){
        return $this->makeCurlCall($url, self::DELETE, $params, null, $headers);
    }

    public function PUT($url, $params =null, $headers = null){
        return $this->makeCurlCall($url, self::PUT, $params, null, $headers);
    }

    public function PATCH($url, $params =null, $headers = null){
        return $this->makeCurlCall($url, self::PATCH, $params, null, $headers);
    }

    private function makeCurlCall($url, $method = self::GET, $posts = null, $gets = null, $headers = null)
    {
        $ch = curl_init();
        if ($gets != null && $method === self::GET) {
            $url .= "?" . $gets;
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->reQuestTimeOut);

        if ($headers == null || !is_array($headers)) {
            $headers = array();
        }
        if ($posts != null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
        }
        if (count($headers) > 0) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if ($method === self::POST) {
            curl_setopt($ch, CURLOPT_POST, true);
        } else if ($method === self::PUT) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::PUT);
        } else if ($method === self::PATCH) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::PATCH);
        } else if ($method == self::HEAD) {
            curl_setopt($ch, CURLOPT_NOBODY, true);
        } else if ($method === self::DELETE) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, self::DELETE);
        }
        if ($headers != null && is_array($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($ch);
        if ((curl_errno($ch) == 60)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
        }
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (curl_errno($ch)) {
            $response = curl_error($ch);
        }
        curl_close($ch);

        return array(
            "code" => $httpStatus,
            "response" => $response
        );
    }

    public static function getInstance(){
        return new AutoBillApiCaller();
    }
}
