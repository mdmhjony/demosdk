<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Invoice\InvoiceData;
use Api\ApiHelper\Config\ConfigManager;

class InvoiceManager
{
    private $invoiceService;
    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->invoiceService = new InvoiceData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->invoiceService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $id='INV-UXYGB9-0001';
        try {
            $response = $this->invoiceService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadOrderInvoice()
    {
        $orderId='ORD-UXYGB9-0001';

        try {
            $response = $this->invoiceService->readOrderInvoice($orderId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsInformation()
    {
        $id='INV-QUEIMF-0015';
        try {
            $invoice = $this->invoiceService->readDetailsInformation($id);
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreateOrderInvoice()
    {
        $params = [
            'invoice' => [
                // 'id' => 'INV-DIPZQZ-0001', // Optional: Unique identifier for the invoice
                'invoice_note' => 'note'
            ]
        ];
        $orderID='ORD-Y1B8-000-0134';
        try {
            $invoice = $this->invoiceService->createOrderInvoice($params,$orderID);
            echo '<pre>' . json_encode($invoice, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadAccountInvoices()
    {
        $accountId='BHLBRD';

        try {
            $response = $this->invoiceService->readAccountInvoices($accountId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAmend()
    {

        $params = [
            "invoice" => [
                "lines" => [
                    // [
                    //     "operation" => "ADD",
                    //     "value" => [
                    //         // "item_id" => "IT3M-0031",
                    //         "item_uuid" => "aaca8224-0e66-4e8a-8ba0-2441bd77df51",
                    //         // "item_name" => "item 1 update ",
                    //         "item_invoice_note" => "note updated",
                    //         "item_quantity" => "3",
                    //         "item_price" => "10.123645",
                    //         "item_discount_amount" => "0.25",
                    //     ]
                    // ],
                    // [
                    //     "operation" => "UPDATE",
                    //     "uuid" => "078FC249-C396-4409-B10C-AE0873F8B12B",
                    //     "item_order_quantity" => "2"
                    // ],
                    [
                        "operation" => "UPDATE",
                        // "item_order_quantity" => "1",
                        "item_price" => "16.00",
                        "item_discount_amount" => "15.00",
                        // "item_uuid" => "aaca8224-0e66-4e8a-8ba0-2441bd77df51",
                        "uuid" => "D5FC7F8A-E616-432A-B742-A5A54515A003"
                    ]
                ],
            ]
        ];

        $id='INV-UXYGB9-0001';

        try {
            $response = $this->invoiceService->createAmend($params,$id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id='INV-UXYGB9-0005';

        try {
            $response = $this->invoiceService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }





}



    $invoiceManager = new InvoiceManager();
//    $invoiceManager->testReadAll();
//    $invoiceManager->testReadDetails();
//    $invoiceManager->testCreateByID();
//    $invoiceManager->testReadOrderInvoice();
//    $invoiceManager->testCreateOrderInvoice();
//    $invoiceManager->testReadOrderInvoice();
//    $invoiceManager->testCreateOrderInvoice();
//    $invoiceManager->testReadDetailsInformation();
//    $invoiceManager->testReadAccountInvoices();
//    $invoiceManager->testCreateAmend();
//    $invoiceManager->testDelete();