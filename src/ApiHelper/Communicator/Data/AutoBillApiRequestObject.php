<?php
namespace Api\ApiHelper\Communicator\Data;

use Api\ApiHelper\Communicator\AutoBillApiCaller;

class AutoBillApiRequestObject
{

    public $httpMethod;
    public $rawParams = null;
    public $processedParams = null;
    public $processedCondition = null;
    public $contextType = AutoBillApiCaller::APPLICATION_JSON_CONTEXT_TYPE;
    public $apiEngine = null;

}
