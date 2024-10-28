<?php


require '../../vendor/autoload.php';

use Api\Component\ApiConfig;
use Api\AppService\Setting\SettingData;
use Api\ApiHelper\Config\ConfigManager;

class SettingManager
{
    private $settingService;

    public function __construct()
    {
        $configManager = new ConfigManager();
        $authCredentialData = $configManager->getConfig();
        $apiConfig = new ApiConfig($authCredentialData);
        $this->settingService = new SettingData($apiConfig);
    }

    public function testReadAll()
    {
        try {
            $response = $this->settingService->readAll();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadTaxes()
    {
        try {
            $response = $this->settingService->readTaxes();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadPaymentProcessors()
    {
        try {
            $response = $this->settingService->readPaymentProcessors();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadCurrencies()
    {
        try {
            $response = $this->settingService->readCurrencies();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function testReadPricingLevels()
    {
        try {
            $response = $this->settingService->readPricingLevels();
            echo '<pre>' . json_encode($response, JSON_PRETTY_PRINT) . '</pre>';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
 $settingManager = new SettingManager();
// $settingManager->testReadAll();
 $settingManager->testReadTaxes();
// $settingManager->testReadPaymentProcessors();
// $settingManager->testReadCurrencies();
// $settingManager->testReadPricingLevels();