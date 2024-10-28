<?php
namespace Api\ExternalPlugin;

use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\AppService\AutoBillApiException;
use Api\AppService\AutoBillUtil;

class Wiki
{
    private $externalPlugin;
    private $instanceIdentifier;
    const SEARCH_API = "/w_c_wiki/api/v1/read/search-info/search";
    const SUGGESTION_API = "/w_c_wiki/api/v1/read/search-info/suggestion";

    public function __construct(ExternalPlugin $externalPlugin)
    {
        $this->externalPlugin = $externalPlugin;
        $this->instanceIdentifier = $this->externalPlugin->getAuthCredentialData()->getInstanceIdentifier();
    }

    public function search($search){
        $requestBuilder = new AutoBillRequestBuilder($this->externalPlugin->getAuthCredentialData());
        try {
            return $requestBuilder->customRequest(AutoBillUtil::concatURL(self::SEARCH_API,"?uuid=".$this->instanceIdentifier), AutoBillApiSchemeHelper::POST, [
                "wildcard_search" => "%".$search."%"
            ]);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function suggestion($search){
        $requestBuilder = new AutoBillRequestBuilder($this->externalPlugin->getAuthCredentialData());
        try {
            return $requestBuilder->customRequest(AutoBillUtil::concatURL(self::SUGGESTION_API,"?uuid=".$this->instanceIdentifier), AutoBillApiSchemeHelper::POST, [
                "wildcard_search" => "%".$search."%"
            ]);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

}
