<?php

require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Payment\PaymentData;
use Api\ApiHelper\Config\ConfigManager;

class PaymentManager
{
    private $paymentService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->paymentService = new PaymentData($apiConfig);
    }
   public function testReadAll(){
       try {
           $payments = $this->paymentService->readAll();
           echo '<pre>' . json_encode($payments, JSON_PRETTY_PRINT) . '</pre>';
       } catch (Exception $e) {
           echo 'Error: ' . $e->getMessage();
       }
   }
    public function testReadDetails()
    {
        $id = '01853635';
        try {
            $response = $this->paymentService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAccountPaymentDetails()
    {
        $accountId = 'YBEAKQ';
        try {
            $response = $this->paymentService->readAccountPaymentDetails($accountId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadOrderPaymentDetails()
    {
        $orderId = 'ORD-00YBEAKQ-0124';
        try {
            $response = $this->paymentService->readOrderPaymentDetails($orderId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadInvoicePaymentDetails()
    {
        $invoiceId = '03755940';
        try {
            $response = $this->paymentService->readInvoicePaymentDetails($invoiceId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateSinglePayment()
    {
        $invoiceId="INV-Y1B8-0-0120";
        $params = [
            "payment" => [
                "id" => "PMT-1236", // system will generate one if not passed
                "date" => "2024-08-07T12:01:41Z",
                "note" => "payments/note",
                "payment_applied" => [
                    [
                        //    "method" => "cash123",
                        // OR
                        "processor" => "Cash",
                        "amount" => "5.00",
                        "reference" => "abc"
                    ]
                ],
                // "credit_applied" => [
                //     [
                //         "id" => "CRN-006dkd",
                //         "amount" => "1.00"
                //     ]
                // ],
                // "gift_certificates" => [
                //     [
                //         "code" => "GC-0030",
                //         "applied" => "1"
                //     ]
                // ],
                // "custom_attributes" => [
                //     [
                //         "name" => "custom attribute",
                //         "value" => "buy chips"
                //     ]
                // ]
            ]
        ];


        try {
            $response = $this->paymentService->createSinglePayment($invoiceId,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testDelete()
    {
        $id = 'PMT-1236';
        try {
            $response = $this->paymentService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }




}

    $paymentManager= new PaymentManager();
    $paymentManager->testReadAll();
//    $paymentManager->testReadDetails();
//    $paymentManager->testReadAccountPaymentDetails();
//    $paymentManager->testReadOrderPaymentDetails();
//    $paymentManager->testReadInvoicePaymentDetails();
//    $paymentManager->testCreateSinglePayment();
//    $paymentManager->testDelete();