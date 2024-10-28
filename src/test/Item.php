<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Item\ItemData;
use Api\ApiHelper\Config\ConfigManager;

class ItemManager
{
    private $itemService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->itemService = new ItemData($apiConfig);
    }

    public function testReadAll(){
        try {
            $response = $this->itemService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = 'ITEM-0297';
        try {
            $response = $this->itemService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsInformation()
    {
        $id = 'ITEM-0297';
        try {
            $response = $this->itemService->readDetailsInformation($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsSale()
    {
        $id = 'ITEM-0297';
        try {
            $response = $this->itemService->readDetailsSale($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsPurchase()
    {
        $id = 'ITEM-0297';
        try {
            $response = $this->itemService->readDetailsPurchase($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetailsInventories()
    {
        $id = 'ITEM-0297';
        try {
            $response = $this->itemService->readDetailsInventories($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreate()
    {
        $params = [
            "items" => [
                "name" => "standard item warehouse",
                "display_name" => "from SDK API",
                "description" => "description",
                "type" => "STANDARD",
                "invoice_note" => "item invoice note 222",
                "origin" => "NET_SUITE",
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isUsedForSale" => "true",
                        "isDefaultForSale" => "true",
                        "isUsedForPurchase" => "true",
                        "isDefaultForPurchase" => "true"
                    ],
                ],
                "uoms" => [
                    [
                        "name" => "Gram",
                        "isBase" => "true",
                        "saleConversionRate" => "1",
                        "purchaseConversionRate" => "5",
                        "isUsedForSale" => "true",
                        "isUsedForPurchase" => "true"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->itemService->create($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testUpdate()
    {
        $id="49593936";
        $params = [
            "items" => [
                "name" => "update standard item warehouse",
                "display_name" => "update from API",
                "description" => "update description",
                "invoice_note" => "item invoice note 222",
                "origin" => "NET_SUITE",
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isUsedForSale" => "true",
                        "isDefaultForSale" => "true",
                        "isUsedForPurchase" => "true",
                        "isDefaultForPurchase" => "true"
                    ],
                    [
                        "name" => "USD",
                        "isUsedForSale" => "true",
                        "isDefaultForSale" => "false",
                        "isUsedForPurchase" => "true",
                        "isDefaultForPurchase" => "false"
                    ]
                ],
                "uoms" => [
                    [
                        "name" => "Gram",
                        "isBase" => "true",
                        "saleConversionRate" => "2",
                        "purchaseConversionRate" => "5",
                        "isUsedForSale" => "true",
                        "isUsedForPurchase" => "true"
                    ]
                ]
            ]
        ];

        try {
            $response = $this->itemService->update($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testDelete()
    {
        $id = 'ITEM-0310';
        try {
            $response = $this->itemService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreateSale()
    {
        $params = [
            "items" => [
                "uoms" => [],
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isDefaultForSale" => "true",
                        "isUsedForSale" => "true"
                    ],
                    [
                        "name" => "BDT",
                        "isDefaultForSale" => "true",
                        "isUsedForSale" => "true"
                    ]
                ],
                "sale" => [
                    "isEnabled" => "true",
                    "invoice_note" => "invoice note",
                    "accounting_code" => "Sales Revenue",
                    "default_sale_currency" => "AUD",
                    "default_sale_price" => "30.00",
                    "isTaxExemptWhenSold" => "true",
                    "pricing_method" => "STANDARD",
                    "tax_configuration" => [
                        "sale_price_entered_is_inclusive_of_tax" => "true",
                        "sale_price_is_based_on" => "SPECIFIC_TAX_CODE",
                        "tax_code" => [
                            "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                            "code" => "GST",
                            "rate" => "10.000000"
                        ]
                    ],
                    "charge" => [
                        "type" => "ONE_OFF"
                    ],
                    "pricing" => [
                        "type" => "PER_UNIT_PRICING",
                        "pricing_module" => [
                            [
                                "price" => "10.000000",
                                "currency" => "AUD"
                            ],
                            [
                                "price" => "10.000000",
                                "currency" => "BDT"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $id="ITEM-0307";

        try {
            $response = $this->itemService->createSale($params,$id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreatePurchaseWithoutSupplier()
    {
        $params = [
            "items" => [
                "uoms" => [],
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isDefaultForPurchase" => "true"
                    ]
                ],
                "purchase" => [
                    "isEnabled" => "true",
                    "rate_option" => "PER_UNIT",
                    "supplier_management_isEnabled" => "false",
                    "accounting_code" => "Cost of Goods Sold",
                    "purchase_order_note" => "Cost of Goods Sold",
                    "default_purchase_currency" => "AUD",
                    "default_purchase_price" => "5.000000",
                    "isTaxExemptWhenPurchase" => "true",
                    "pricing_profile" => "",
                    "purchase_properties" => [
                        [
                            "name" => "receive_mode",
                            "value" => "MANUAL"
                        ],
                        [
                            "name" => "receive_term",
                            "value" => "Immediately"
                        ]
                    ],
                    "tax_configuration" => [
                        "purchase_price_entered_is_inclusive_of_tax" => "true",
                        "tax_code" => [
                            "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                            "code" => "GST",
                            "rate" => 10
                        ]
                    ],
                    "pricing" => [
                        "type" => "PER_UNIT_PRICING",
                        "pricing_module" => []
                    ]
                ]
            ]
        ];


        $id="ITEM-0306";

        try {
            $response = $this->itemService->createPurchaseWithoutSupplier($params,$id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreatePurchaseWithSupplier()
    {
        $params = [
            "items" => [
                "uoms" => [],
                "currencies" => [
                    [
                        "name" => "AUD",
                        "isDefaultForPurchase" => "true"
                    ]
                ],
                "purchase" => [
                    "isEnabled" => "true",
                    "supplier_management_isEnabled" => "true",
                    "default_purchase_currency" => "AUD",
                    "suppliers" => [
                        [
                            "id" => "",
                            "name" => "DEFAULT",
                            "accounting_code" => "Cost of Goods Sold",
                            "purchase_order_note" => "Cost of Goods Sold",
                            "default_purchase_currency" => "AUD",
                            "default_purchase_price" => "5.000000",
                            "isTaxExemptWhenPurchase" => "true",
                            "pricing" => [
                                "type" => "PER_UNIT_PRICING",
                                "pricing_module" => [
                                    [
                                        "price" => "5.000000",
                                        "currency" => "AUD",
                                        "price_type" => "PRICE"
                                    ]
                                ]
                            ]
                        ],
                        [
                            "id" => "EQBP-0000000130", // change it
                            "name" => "supplier", // change it
                            "accounting_code" => "Cost of Goods Sold",
                            "purchase_order_note" => "Cost of Goods Sold",
                            "default_purchase_currency" => "AUD",
                            "default_purchase_price" => "66.000000",
                            "isTaxExemptWhenPurchase" => "true",
                            "pricing" => [
                                "type" => "PER_UNIT_PRICING",
                                "pricing_module" => [
                                    [
                                        "price" => "5.000000",
                                        "currency" => "AUD",
                                        "price_type" => "PRICE"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];


        $id="ITEM-0311";

        try {
            $response = $this->itemService->createPurchaseWithSupplier($params,$id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReactivate()
    {

        $id="ITEM-0312";
        try {
            $response = $this->itemService->reactivate($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeactivate()
    {
        $id="ITEM-0312";
        try {
            $response = $this->itemService->deactivate($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }









}

    $itemManager= new ItemManager();
//    $itemManager->testReadAll();
//    $itemManager->testReadDetails();
//    $itemManager->testReadDetailsInformation();
//    $itemManager->testReadDetailsSale();
//    $itemManager->testReadDetailsPurchase();
//    $itemManager->testReadDetailsInventories();
//    $itemManager->testCreate();
//    $itemManager->testUpdate();
//    $itemManager->testDelete();
//    $itemManager->testCreateSale();
//    $itemManager->testCreatePurchaseWithoutSupplier();
//    $itemManager->testCreatePurchaseWithSupplier();
//    $itemManager->testReactivate();
//    $itemManager->testDeactivate();
