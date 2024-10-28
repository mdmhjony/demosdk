<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Event\EventData;
use Api\ApiHelper\Config\ConfigManager;

class EventManager
{
    private $eventService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->eventService = new EventData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->eventService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadDetails()
    {
        $uuId="71118384-ca12-401e-8b44-bc2d37230383";
        try {
            $response = $this->eventService->readDetails($uuId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function testRemove()
    {
        $uuId="fb97df08-0e5e-4906-861b-9e2d268a929e";
        try {
            $response = $this->eventService->remove($uuId);
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}

$eventManager = new EventManager();
//$eventManager->testReadAll();
//$eventManager->testReadDetails();
 $eventManager->testRemove();