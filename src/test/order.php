<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Order\OrderData;
use Api\ApiHelper\Config\ConfigManager;

class OrderManager
{
    private $orderService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->orderService = new OrderData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->orderService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id = 'ORD-Y1B8-000-0141';
        try {
            $response = $this->orderService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadInformation()
    {
        $id = 'ORD-UXYGB9-0001';
        try {
            $response = $this->orderService->readInformation($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadAccountOrders()
    {
        $accountID = 'Y1B8-0000000123';
        try {
            $response = $this->orderService->readAccountOrders($accountID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadBillingPreferences()
    {
        $accountID = 'ORD-Y1B8-000-0139';
        try {
            $response = $this->orderService->readAccountOrders($accountID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderLines()
    {
        $id = 'ORD-Y1B8-000-0139';
        try {
            $orderInfo = $this->orderService->readOrderLines($id);
            echo '<pre>' . json_encode($orderInfo, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsOrderLine()
    {
        $id = 'ORD-Y1B8-000-0139';
        $chargeItemUUID="e98d11e2-c6e7-4a71-a145-073a9e3df316";
        try {
            $orderInfo = $this->orderService->readDetailsOrderLine($id,$chargeItemUUID);
            echo '<pre>' . json_encode($orderInfo, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testCreate()
    {
        $params = [
                "account_id" => "Y1B8-0000000123",
                // "redemption_code" => "ITEM-0007",
                "lines" => [
                    [
                        "item_id" => "07237601-UA",
                        "item_order_quantity" => "10",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "150"
                            ]
                        ]
                    ]
                ]
        ];


        try {
            $response = $this->orderService->create($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testCreateOrderWithPurchase()
    {
        $params = [
            "order" => [
                "name" => "renting2",
                "id" => "ORD_7a166f54kglfl",
                "account_id" => "VHZB-0000000125",
                "properties" => [
                    "communication_profile" => "",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "payment_processor" => "Cash",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Net 30",
                    "payment_term_alignment" => "BILLING_DATE",
                    "fulfillment_mode" => "MANUAL",
                    "fulfillment_term" => "Immediately"
                ],
                "lines" => [
                    [
                        "item_id" => "ITEM-0297",
                        "item_quantity" => "1",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "5"
                            ]
                        ],
                        "purchase_order" => [
                            "create_po" => "true",
                            "po_information" => [
                                "id" => "VHZB-0000000125klmfl",
                                "name" => "Land Owner",
                                "account_id" => "28YD-0000000126",
                                "currency" => "AUD",
                                "item_quantity" => "1",
                                "item_price_snapshot" => [
                                    "pricing_rule" => [
                                        "price" => "4"
                                    ]
                                ]
                            ]
                        ]
                    ],
                    [
                        "item_id" => "ITEM-0297",
                        "item_quantity" => "1",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "0"
                            ]
                        ],
                        "purchase_order" => [
                            "create_po" => "true",
                            "po_information" => [
                                "id" => "comission_7a166f5434",
                                "account_id" => "I3XW-0000000127",
                                "currency" => "AUD",
                                "item_quantity" => "1",
                                "item_price_snapshot" => [
                                    "pricing_rule" => [
                                        "price" => "2.00"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->createOrderWithPurchase($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCancel()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-08-13"
            ]
        ];
        $id='ORD-Y1B8-000-0136';
        try {
            $response = $this->orderService->cancel($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChangeInformation()// PATCH
    {
        $params = [
            "order" => [
                "name" => "My Collection",
                "display_name" => "My Collection",
                "description" => "Exclusive Item",
                "manager" => "Administrator",
                "origin" => "NetSuite",
                "invoice_note" => "Invoice note",
                "communication_preference" => [
                    [
                        "media" => "EMAIL",
                        "isEnabled" => "true"
                    ],
                    [
                        "media" => "POSTAL_EMAIL",
                        "isEnabled" => "true"
                    ],
                    [
                        "media" => "TEXT_MESSAGE",
                        "isEnabled" => "true"
                    ],
                    [
                        "media" => "VOICE_MAIL",
                        "isEnabled" => "true"
                    ]
                ]
            ]
        ];
        $id='ORD-UXYGB9-0001';
        try {
            $response= $this->orderService->changeInformation($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangeBillingPreferences()// PATCH
    {

        $params = [
            "order" => [
                "properties" => [
                    "communication_profile" => "AutoBill Communication Profile",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "payment_processor" => "Cash",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Net 30",
                    "payment_term_alignment" => "BILLING_DATE",
                    "fulfillment_mode" => "MANUAL",
                    "fulfillment_term" => "IMMEDIATELY"
                ]
            ]
        ];
        $id='ORD-Y1B8-000-0139';
        try {
            $response = $this->orderService->changeBillingPreferences($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdateBillingPreferences()// PUT
    {

        $params = [
            "order" => [
                "properties" => [
                    "communication_profile" => "AutoBill Communication Profile",
                    "invoice_mode" => "AUTOMATIC",
                    "invoice_term" => "Billing Start Date",
                    "billing_period" => "1 Month",
                    "payment_processor" => "Cash",
                    "payment_mode" => "MANUAL",
                    "payment_term" => "Net 30",
                    "payment_term_alignment" => "BILLING_DATE",
                    "fulfillment_mode" => "MANUAL",
                    "fulfillment_term" => "IMMEDIATELY"
                ]
            ]
        ];
        $id='ORD-Y1B8-000-0139';
        try {
            $response = $this->orderService->updateBillingPreferences($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChangeOrderLineInformation()// PATCH
    {
        $params = [
            "order" => [
                "line" => [
                    "item_name" => "chips",
                    "item_invoice_note" => "note",
                    "item_description" => "description",
                    "item_custom_attributes" => [
                        [
                            "name" => "Mug",
                            "value" => "plastic material"
                        ]
                    ]
                ]
            ]
        ];
        $id='ORD-Y1B8-000-0139';
        $chargeItemUUID="e98d11e2-c6e7-4a71-a145-073a9e3df316";
        try {
            $response = $this->orderService->changeOrderLineInformation($params, $id,$chargeItemUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testOrderDelete()
    {
        $id='ORD-Y1B8-000-0133';
        try {
            $response = $this->orderService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testCreateOrderUsages()
    {
        $params = [
            'usage' => [
                'charge_item_uuid' => '1e76f204-f71d-457d-a177-c6bb42f9d5bf',
                'charging_period' => '2024-08-06-2024-09-05',
                'quantity' => '2',
                'end_time' => '2024-09-02 01:01:01',
                'type' => 'Incremental',

            ]
        ];


        try {
            $response = $this->orderService->createOrderUsages($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReactivate()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-08-13"
            ]
        ];
        $id='ORD-Y1B8-000-0136';
        try {
            $response = $this->orderService->reactivate($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChange()
    {
        $params = [
            "order" => [
                "effective_date" => "2024-08-13",
                "lines" => [
                    [
                        "op" => "change",
                        "uuid" => "e98d11e2-c6e7-4a71-a145-073a9e3df316",
                        "item_order_quantity" => "3",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "5.000000"
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $id='ORD-Y1B8-000-0139';
        try {
            $response = $this->orderService->change($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateWithFamilyType()
    {
        $params = [
            "order" => [
                "account_id" => "YBEAKQ",
                "allow_contract" => "True",
                "contract_properties" => [
                    "require_customer_acceptance" => "True",
                    "requires_payment_method" => "False",
                    "initial_contract_term" => "1 Year",
                    "renew_automatically" => "True",
                    "auto_renewal_term" => "1 Week",
                    "allow_early_termination" => "TRUE",
                    "early_termination_minimum_period" => "1 Day",
                    "apply_early_termination_charge" => "False",
                    "allow_postponement" => "True",
                    "maximum_duration_per_postponement" => "1 Day",
                    "maximum_postponement_count" => "1",
                    "allow_trial" => "True",
                    "start_contract_after_trial_ends" => "True",
                    "trial_period" => "1 day",
                    "allow_downgrade" => "True",
                    "period_before_downgrade" => "1 Day",
                    "allow_downgrade_charge" => "True",
                    "downgrade_charge_type" => "Fixed",
                    "downgrade_charge_fixed" => "23.000000",
                    "allow_upgrade" => "True"
                ],
                "lines" => [
                    [
                        "item_id" => "ITEM-0023",
                        "package_name" => "",
                        "item_order_quantity" => "1",
                        "item_price_snapshot" => [
                            "pricing_rule" => [
                                "price" => "0.000000"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->createWithFamilyType($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDowngrade()
    {
        $id="ORD-76GOU2-1101";
        $params = [
            "effective_date" => "2024-09-23",
            "lines" => [
                [
                    "item_id" => "ITEM-0027",
                    "item_name" => "recuring family item",
                    "charge_item_uuid"=> "f903c582-abc1-4303-be8a-68b263227319",
                    "package_name" => "basic package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "10.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "warehouse1",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];


        try {
            $response = $this->orderService->downgrade($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpgrade()
    {
        $id="ORD-76GOU2-1101";
        $params = [
            "effective_date" => "2024-09-23",
            "lines" => [
                [
                    "item_id" => "ITEM-0027",
                    "item_name" => "recuring family item",
                    "charge_item_uuid"=> "f903c582-abc1-4303-be8a-68b263227319",
                    "package_name" => "standard package",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "10.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "warehouse1",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "d166b28c-395b-4692-87b9-7408a01b72c0",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];


        try {
            $response = $this->orderService->upgrade($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpgradePreview()
    {
        $id = "ORD-00QUEIMF-0155";
        $params = [
            "effective_date" => "2024-10-27",
            "lines" => [
                [
                    "item_id" => "ITEM-0326",
                    "item_name" => "fitem",
                    "charge_item_uuid" => "85e3348e-25d0-4e51-99f3-21691a14ff64",
                    "package_name" => "standard pac",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "20.000000"
                        ]
                    ],
                    "discount" => "9.99",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "BrandNet",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];

        try {
            $response = $this->orderService->upgradePreview($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDowngradePreview()
    {
        $id = "ORD-00QUEIMF-0155";
        $params = [
            "effective_date" => "2024-10-18",
            "lines" => [
                [
                    "item_id" => "ITEM-0326",
                    "item_name" => "fitem",
                    "charge_item_uuid" => "85e3348e-25d0-4e51-99f3-21691a14ff64",
                    "package_name" => "basic pac",
                    "quantity" => "10",
                    "item_price_snapshot" => [
                        "pricing_rule" => [
                            "price" => "1.000000"
                        ]
                    ],
                    "discount" => "0.00",
                    "shipping_cost" => "2.50",
                    "uom" => "kilogram",
                    "warehouse" => "BrandNet",
                    "is_tax_exempt_when_sold" => "false",
                    "item_price_tax" => [
                        "uuid" => "E2C16096-06B5-42A8-8F2A-743D7F35F9D9",
                        "code" => "GST",
                        "rate" => "10.000000"
                    ],
                    "accounting_code" => "Sales Revenue",
                    "item_invoice_note" => "this is an invoice note",
                    "item_description" => "One hot day, a thirsty crow flew all over the fields looking for water. For a long time, he could not find any.",
                    "item_custom_attributes" => [
                        [
                            "name" => "cus_attr_number",
                            "value" => ""
                        ],
                        [
                            "name" => "cus_attr_string",
                            "value" => ""
                        ]
                    ]
                ]
            ]
        ];



        try {
            $response = $this->orderService->downgradePreview($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateExpress()
    {
        $params = [
            "account" => [
                "id" => "MKNX-0000000103",
                "order" => [
                    "price_tax_inclusive" => "true",
                    "order_start_date" => "2024-10-01",
                    "name" => "Order 1",
                    "lines" => [
                        [
                            "item_id" => "ITEM-0294",
                            "item_order_quantity" => "1",
                            "item_price_snapshot" => [
                                "pricing_rule" => [
                                    "price" => "200"
                                ]
                            ]
                        ]
                    ],
                    "payment_methods" => ["refcheque"],
                    "invoice" => [
                        "custom_attributes" => [],
                        "payment" => [
                            "payment_applied" => [
                                [
                                    "method" => "refcheque",
                                    "amount" => "200"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];


        try {
            $response = $this->orderService->createExpress($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testChangePaymentMethod()
    {
        $params = [
            "order" => [
                "payment_methods" => "anyref"
            ]
        ];

        $id='ORD-MKNX-000-0129';
        try {
            $response= $this->orderService->changePaymentMethod($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }









}


    $orderManager = new OrderManager();
//    $orderManager->testReadAll();
//    $orderManager->testCreateOrderUsages();
//    $orderManager->testReadInformation();
//    $orderManager->testChangeInformation();
//    $orderManager->testDelete();
//    $orderManager->testReactivate();
//    $orderManager->testChange();
//    $orderManager->testReadAccountOrders();
//    $orderManager->testReadBillingPreferences();
//    $orderManager->testReadOrderLines();
//    $orderManager->testReadDetailsOrderLine();
//    $orderManager->testChangeOrderLineInformation();
//    $orderManager->testCreateOrderWithPurchase();
//    $orderManager->testChangeBillingPreferences();
//    $orderManager->testUpdateBillingPreferences();
//    $orderManager->testReadDetails();
   $orderManager->testCreate();
//    $orderManager->testCancel();
//    $orderManager->testCreateWithFamilyType();
//    $orderManager->testUpgrade();
//    $orderManager->testDowngrade();
//    $orderManager->testUpgradePreview();
//    $orderManager->testDowngradePreview();
//    $orderManager->testCreateExpress();
    // $orderManager->testChangePaymentMethod();