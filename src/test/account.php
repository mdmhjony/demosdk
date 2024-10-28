<?php
require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Account\AccountData;
use Api\ApiHelper\Config\ConfigManager;

class AccountManager
{
    private $accountService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->accountService = new AccountData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->accountService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetails()
    {
        $id='W56L-0000000128';
        try {
            $response = $this->accountService->readDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadDetailsInformation()
    {
        $id="FZUK-0000000110";
        try {
            $response = $this->accountService->readDetailsInformation($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreate()
    {
        $params = [
            "name" => "abcd",
            "email_address" => "basicinformationsami123@gmail.com",
        ];

        try {
            $response = $this->accountService->create($params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testUpdate()
    {
        $params = [
            "name" => "ABCD",
            "display_name" => "ABCD",
            "description" => "updated description",
            "email_address" => "bhai3@abc.com"
        ];
        $id='W56L-0000000128';
        try {
            $response = $this->accountService->update($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDelete()
    {
        $id="FZUK-0000000110";
        try {
            $response = $this->accountService->delete($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testCreatePayment()
    {
        $params= [
            'processor_type' => 'OTHER',
            'default' => true,
            'payment_processor' => 'Cheque',
            'reference' => 'Reference-Ch'
        ];
        $id='IPII7N';
        try {
            $response = $this->accountService->createPayment($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateCardPayment()
    {
        $params = [
            'processor_type' => 'DIRECT_CREDIT',
            'default' => true,
            'payment_processor' => 'n_stripe',
            'card_type' => 'Visa',
            'token' => 'tok_1PqWukGyILatr1r3PueO3Aia',
            'card_id'=> 'card_1P8wruGyILatr1r3kHPKGrR1',
            'card_number' => '4242 4242 4242 4242',
            'expiry_month' => '06',
            'expiry_year' => '2029',
            'reference' => 'pink_floyd4',
        ];
        $id='IPII7N';

        try {
            $response = $this->accountService->createCardPayment($params, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public  function testReadPayment()
    {
        $id="KD2Z-0000000112";
        try {
            $response = $this->accountService->readPayment($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testDeletePayment()
    {
        $id = "KD2Z-0000000112";
        $ref = "Reference-Ch";
        try {
            $response = $this->accountService->deletePayment($id, $ref);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



    public function testDetailsPayment()
    {
        $id = "KD2Z-0000000112";
        $ref = "pink_floyd";
        try {
            $response = $this->accountService->detailsPayment($id, $ref);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testUpdatesPaymentAllData()  //PATCH
    {
        $params = [
            "default" => "false",
            "use_for_specified_orders" => "false",
            "specified_orders" => [
                [
                    "order_id" => "ORD-00QUEIMF-0137"
                ]
            ],
            "reference" => "Reference-Ch"
        ];
        $id='VHZB-0000000125';
        $reference= "Cheque-ref";
        try {
            $updatesPayment = $this->accountService->updatesPaymentAllData($params, $id,$reference);
            echo '<pre>' . json_encode($updatesPayment, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadContactDetails()
    {
        $id="WPNP-0000000124";
        try {
            $response = $this->accountService->readContactDetails($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadContactTypeDetails()
    {
        $id="Y1B8-0000000123";
        $contactType= "CONTACT_1";
        try {
            $response = $this->accountService->readContactTypeDetails($id,$contactType);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testUpdateContactTypeDetails()//PUT
    {
        $params = [
            "account" => [
                "contact" => [

                    "salutation" => "Fraulein",
                    "designation" => "CEO",
                    "first_name" => "Roza",
                    "middle_name" => "rrTabassum",
                    "email" => [
                        "address" => "abc@yopmail.com",
                        "do_not_email" => "false"
                    ],
                    "address_line_1" => "9 Yarra",
                    "address_line_2" => "10 Yarra",
                    "address_line_3" => "11 Yarra",
                    "address_line_4" => "12 Yarraaa",
                    "address_line_5" => "13 Yarra",
                    "post_code" => "3737",
                    "city" => "Abbeyard",
                    "state" => "Victoria",
                    "country" => "Australia",
                    "phone" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "546464",
                        "do_not_call" => "true"
                    ],
                    "fax" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        "do_not_call" => "true"
                    ],
                    "mobile" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        // "full" => "807060",
                        "do_not_call" => "true"
                    ],

                    "receive_billing_information" => "true"
                ]
            ]
        ];

        $id="Y1B8-0000000123";
        $contactType= "CONTACT_1";
        try {
            $response = $this->accountService->updateContactTypeDetails($params, $id,$contactType);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testChangeContactTypeDetails()// PATCH
    {
        $params = [
            "account" => [
                "contact" => [

                    "salutation" => "Fraulein",
                    "designation" => "CEO",
                    "first_name" => "Roza",
                    "middle_name" => "rrTabassum",
                    "email" => [
                        "address" => "abc@yopmail.com",
                        "do_not_email" => "false"
                    ],
                    "address_line_1" => "9 Yarra",
                    "address_line_2" => "10 Yarra",
                    "address_line_3" => "11 Yarra",
                    "address_line_4" => "12 Yarraaa",
                    "address_line_5" => "13 Yarra",
                    "post_code" => "3737",
                    "city" => "Abbeyard",
                    "state" => "Victoria",
                    "country" => "Australia",
                    "phone" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "546464",
                        "do_not_call" => "true"
                    ],
                    "fax" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        "do_not_call" => "true"
                    ],
                    "mobile" => [
                        "country_code" => "+61",
                        "area_code" => "03",
                        "number" => "5464",
                        // "full" => "807060",
                        "do_not_call" => "true"
                    ],

                    "receive_billing_information" => "true"
                ]
            ]
        ];

        $id="Y1B8-0000000123";
        $contactType= "CONTACT_1";
        try {
            $updateInfo = $this->accountService->changeContactTypeDetails($params, $id,$contactType);
            echo '<pre>' . json_encode($updateInfo, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteContactTypeDetails()
    {

        $id="VHZB-0000000125";
        $contactType= "CONTACT_1";
        try {
            $response = $this->accountService->deleteContactTypeDetails($id,$contactType);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAllNotes()
    {
        $id="VHZB-0000000125";
        try {
            $response = $this->accountService->readAllNotes($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadNoteDetails()
    {
        $id="VHZB-0000000125";
        $noteUUID="503864e2-2267-4fa8-af18-8cdc97ab0887";
        try {
            $response = $this->accountService->readNoteDetails($id,$noteUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadNoteFiles()
    {
        $id="VHZB-0000000125";
        $noteUUID="503864e2-2267-4fa8-af18-8cdc97ab0887";
        try {
            $response = $this->accountService->readNoteFiles($id,$noteUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadNoteFileDetails()
    {
        $id="VHZB-0000000125";
        $noteUUID="503864e2-2267-4fa8-af18-8cdc97ab0887";
        $fileUUID="bcde8159-4890-446e-93d4-7b9247b529ea";
        try {
            $response = $this->accountService->readNoteFileDetails($id,$noteUUID,$fileUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testAddNote()
    {
        $id = 'VHZB-0000000125';
        $filePaths = 'C:\Users\Mehedi\Downloads\n.txt';
        $note = 'from sdk';

        try {
            $response = $this->accountService->addNote($filePaths, $note, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



//    public function testAddNote() {
//        $id = 'VHZB-0000000125';
//        $filePaths = [
//            'C:\Users\Mehedi\Downloads\k.txt',
//            'C:\Users\Mehedi\Downloads\n.txt'
//        ];
//        $note = 'last';
//
//        try {
//            $addInfo = $this->accountService->addNote($filePaths, $note, $id);
//            echo '<pre>' . json_encode($addInfo, JSON_PRETTY_PRINT) . '</pre>';
//        } catch (Exception $e) {
//            echo 'Error: ' . $e->getMessage();
//        }
//    }


    public function testAddNoteFiles()
    {
        $id = 'WPNP-0000000124';
        $noteUUID='73261368-895f-4784-9573-9d5f16149ef4';
        $filePath = 'C:\Users\Mehedi\Downloads\k.txt';
        try {
            $response = $this->accountService->addNoteFiles($filePath, $id,$noteUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testDeleteNote()
    {
        $accountID="VHZB-0000000125";
        $noteUUID="f824fa34-08d2-4c3d-971d-42899973ca03";

        try {
            $response = $this->accountService->deleteNote($accountID,$noteUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testDeleteNoteFile()
    {
        $accountID="VHZB-0000000125";
        $noteUUID="7e273373-0e55-4313-a330-70b18429ae74";
        $fileUUID="020e6b9f-cab9-4c9f-8943-6f998cb81b88";
        try {
            $response = $this->accountService->deleteNoteFile($accountID,$noteUUID,$fileUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testReadAddresses()
    {
        $id="VHZB-000000125";
        try {
            $response = $this->accountService->readAddresses($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testReadAddressDetails()
    {
        $id="VHZB-0000000125";
        $addressUUID="95cb7b54-b836-4f57-b8f6-4534747ec56f";
        try {
            $response = $this->accountService->readAddressDetails($id,$addressUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testCreateAddresses()
    {
        $id="VHZB-0000000125";
        $params = [
                'addresses' => [
                    [
                        'address_line_1' => '9 Yarra',
                        'address_line_2' => '10 Yarra',
                        'address_line_3' => '11 Yarra',
                        'address_line_4' => '12 Yarra',
                        'address_line_5' => '13 Yarra',
                        'post_code' => '3737',
                        'city' => 'Abbeyard',
                        'state' => 'Victoria',
                        'country' => 'Australia',
                        'isDefaultBilling' => 'false',
                        'isDefaultShipping' => 'false'
                    ],
                    [
                        'address_line_1' => 'House 15',
                        'address_line_2' => 'Road 20',
                        'address_line_3' => 'Block A',
                        'address_line_4' => 'Section 8',
                        'address_line_5' => 'Road 9',
                        'post_code' => '3737',
                        'city' => 'Abbeyard',
                        'state' => 'Victoria',
                        'country' => 'Australia',
                        'isDefaultBilling' => 'false',
                        'isDefaultShipping' => 'false'
                    ]
                ]
            ];

        try {
            $response = $this->accountService->createAddresses($id,$params);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testChangeAddress()
    {
        $id = "VHZB-0000000125";
        $addressUUID = "f0e02b65-9b65-48d9-bebd-89d3fd209c44";
        $params = [
            'address' => [
                'address_line_1' => 'House 15',
                'address_line_2' => 'Road 20',
                'address_line_3' => 'Block A',
                'address_line_4' => 'Section 8',
                'address_line_5' => 'Road 9',
                'post_code' => '3737',
                'city' => 'Abbeyard1',
                'state' => 'Victoria',
                'country' => 'Australia',
                'isDefaultBilling' => 'false',
                'isDefaultShipping' => 'false'
            ]
        ];

        try {
            $response = $this->accountService->changeAddresses($id, $params, $addressUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public function testDeleteAddress()
    {
        $id = "VHZB-0000000125";
        $addressUUID = "430bc53c-91f2-437d-8d50-65ce2d6af2e9";

        try {
            $response = $this->accountService->deleteAddress($id,$addressUUID);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testGetImage()
    {
        $id="VHZB-0000000125";
        try {
            $response = $this->accountService->getImage($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testAddImage()
    {
        $id = 'VHZB-0000000125';
        $filePath = "C:\Users\Mehedi\Downloads\img.jpg";
        try {
            $response = $this->accountService->addimage($filePath, $id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testDeleteImage()
    {
        $id = "VHZB-0000000125";

        try {
            $response = $this->accountService->deleteImage($id);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }






}





//    Test Function Call here
    $accountManager = new AccountManager();
    // $accountManager->testReadAll();
//    $accountManager->testReadDetails();
//    $accountManager->testReadDetailsInformation();
   $accountManager->testCreate();
//    $accountManager->testUpdate();
//    $accountManager->testDelete();
//    $accountManager->testCreatePayment();
//    $accountManager->testCreateCardPayment();
//    $accountManager->testReadPayment();
//    $accountManager->testDetailsPayment();
//    $accountManager->testDeletePayment();
//    $accountManager->testUpdatesPaymentAllData();
//    $accountManager->testReadContactDetails();
//    $accountManager->testReadContactTypeDetails();
//    $accountManager->testUpdateContactTypeDetails();
//    $accountManager->testChangeContactTypeDetails();
//    $accountManager->testDeleteContactTypeDetails();
//    $accountManager->testReadAllNotes();
//    $accountManager->testReadNoteDetails();
//    $accountManager->testAddNote();
//    $accountManager->testAddNoteFiles();
//    $accountManager->testReadNoteFiles();
//    $accountManager->testReadNoteFileDetails();
//    $accountManager->testDeleteNote();
//    $accountManager->testDeleteNoteFile();
//    $accountManager->testReadAddresses();
//    $accountManager->testReadAddressDetails();
//    $accountManager->testCreateAddresses();
//    $accountManager->testChangeAddress();
//    $accountManager->testDeleteAddress();
//    $accountManager->testGetImage();
//    $accountManager->testAddImage();
//    $accountManager->testDeleteImage();