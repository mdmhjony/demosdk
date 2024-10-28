<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\PurchaseOrder\PurchaseOrderData;
use Api\ApiHelper\Config\ConfigManager;

class PurchaseOrderManager
{
    private $purchaseOrderService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->purchaseOrderService = new PurchaseOrderData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->purchaseOrderService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $id = 'PO-ST4N-0-0001';
        try {
            $response = $this->purchaseOrderService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsInformation()
    {
        $id = 'PO-ST4N-0-0001';
        try {
            $response = $this->purchaseOrderService->readDetailsInformation($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadLines()
    {
        $id = 'PO-ST4N-0-0001';
        try {
            $response = $this->purchaseOrderService->readLines($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadLineDetails()
    {
        $id = 'PO-ST4N-0-0001';
        $uuId='d3aeb145-7bfb-4289-85e5-f3f0505ad583';
        try {
            $response = $this->purchaseOrderService->readLineDetails($id,$uuId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadAccountPurchaseOrders()
    {
        $accountId = 'ST4N-0000000131';
        try {
            $response = $this->purchaseOrderService->readAccountPurchaseOrders($accountId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testCreate()
    {
        $params = [
            "purchase-order" => [
                "currency" => "AUD",
                "price_tax_inclusive" => "true",
                "account_id" => "ST4N-0000000131",
                "lines" => [
                    [
                        "item_uuid" => "1b1fe62c-e494-432a-aafb-fc75bd82681e",
                        "item_quantity" => "40.000000",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price_type" => "INCREMENTAL_PER_UNIT_PRICING",
                                "price" => "2.000000"
                            ]
                        ],
                        "item_purchase_tax_configuration" => [
                            "purchase_price_is_tax_inclusive" => "true",
                            "tax_code" => [
                                "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                                "code" => "GST",
                                "rate" => "10.000000"
                            ]
                        ],
                        "item_price_tax_exempt" => "false",
                        "item_price_tax" => [
                            "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                            "code" => "GST",
                            "rate" => "10.000000"
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->purchaseOrderService->create($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id = 'VHZB-0000000125klm';
        try {
            $response = $this->purchaseOrderService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


}

$purchaseOrderManager = new PurchaseOrderManager();
//$purchaseOrderManager->testReadAll();
//$purchaseOrderManager->testReadDetails();
$purchaseOrderManager->testCreate();
//$purchaseOrderManager->testReadDetailsInformation();
//$purchaseOrderManager->testReadLines();
//$purchaseOrderManager->testReadLineDetails();
//$purchaseOrderManager->testReadAccountPurchaseOrders();
//$purchaseOrderManager->testDelete();
