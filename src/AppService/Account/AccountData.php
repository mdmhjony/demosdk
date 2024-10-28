<?php

namespace Api\AppService\Account;
use Api\ApiHelper\AutoBillApiSchemeHelper;
use Api\ApiHelper\AutoBillRequestBuilder;
use Api\ApiHelper\Communicator\ApiResource;
use Api\AppService\AutoBillApiException;
use Api\AppService\Model\Account;
use Api\AppService\Model\Billing_preferences;
use Api\Component\ApiConfig;

class AccountData
{
    private $apiConfig;
    const GET_ACCOUNT_API = "api/v1/";

    public function __construct(ApiConfig $apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }



    public function readAll(){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetails($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readDetailsInformation($id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $id, [], 'information');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function create($params) {

        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = "{ "."\"account\": " .$json." " ." }";
        $json = json_decode($json);
        try {
            return $requestBuilder->callResource(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST, null, $json);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function update($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = "{ "."\"account\": " .$json." " ." }";
        $json = json_decode($json);

        try {
            return $requestBuilder->callResource(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::PATCH, $id, $json);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function delete($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResource(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::DELETE, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function deletePayment($id,$ref){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute = "payment-methods/" . $ref;

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::DELETE, $id, [], $attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createPayment($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json= "{ \"account\": { \"payment_method\": " . $json. " } }";
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST, $id, $json, 'payment-methods');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createCardPayment($params, $id)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json= "{ \"account\": { \"payment_method\": " . $json. " } }";
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST, $id, $json, 'payment-methods');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



    public function readPayment($id){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAccountPaymentMethod(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $id);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


    public function detailsPayment($id, $ref)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute = "payment-methods/" . $ref;

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $id, [], $attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readContactDetails($id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::GET, $id, [], 'contacts');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readContactTypeDetails($id, $contactType) {
        $attribute= "contacts/$contactType";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function changeContactTypeDetails($params,$id, $contactType) {
        $json = json_encode($params);
        $json = json_decode($json);
        $attribute= "contacts/$contactType";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::PUT,$id,$json,$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function updateContactTypeDetails($params,$id, $contactType) {
        $json = json_encode($params);
        $json = json_decode($json);
        $attribute= "contacts/$contactType";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::PATCH,$id,$json,$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function deleteContactTypeDetails($id, $contactType) {
        $attribute= "contacts/$contactType";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::DELETE,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



    public function updatesPaymentAllData($params, $id= null,$reference)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute="payment-methods/$reference";
        $json = json_encode($params);
        $json= "{ \"account\": { \"payment_method\": " . $json. " } }";
        $json = json_decode($json);
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::PATCH, $id, $json, $attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



    public function readAllNotes($id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],"notes");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readNoteDetails($id, $noteUUID) {
        $attribute="notes/$noteUUID";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readNoteFiles($id, $uuid) {
        $attribute="notes/$uuid/files";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readNoteFileDetails($id,$noteUUID,$fileUUID){
        $attribute="notes/$noteUUID/files/$fileUUID";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addNote($filePath=null, $note, $id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $data = [];

        if ($filePath) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        if ($note) {
            $data['note'] = $note;
        }

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::POST,$id,$data,"notes");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }


//    public function addNote($filePaths = [], $note, $id) {
//        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
//        $data = [];
//
//        // Handle multiple file paths
//        if (!empty($filePaths)) {
//            foreach ($filePaths as $filePath) {
//                if (file_exists($filePath)) {
//                    $mimeType = mime_content_type($filePath);
//                    $data['file'][] = new \CURLFile($filePath, $mimeType, basename($filePath));
//                }
//            }
//        }
//
//
//        // Add the note if it's not empty
//        if (!empty($note)) {
//            $data['note'] = $note;
//        }
//
//        try {
//            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST, $id, $data, "notes");
//        } catch (AutoBillApiException $e) {
//            throw new AutoBillApiException($e->getMessage());
//        }
//    }


    public function addNoteFiles($filePath,$id,$noteUUID) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $data = [];

        if ($filePath) {
            $mimeType = mime_content_type($filePath);
            $data['file'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        }

        $attribute="notes/$noteUUID/files";


        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::POST,$id,$data,$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function deleteNote($id=null, $UUID=null) {
        $attribute= "notes/$UUID";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::DELETE,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function deleteNoteFile($id=null, $noteUUID=null, $fileUUID=null) {
        $attribute= "notes/$noteUUID/files/$fileUUID";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::DELETE,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function readAddresses($id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],"addresses");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function readAddressDetails($id,$addressUUID) {
        $attribute= "addresses/$addressUUID";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function createAddresses($id,$params){
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $json = json_encode($params);
        $json = "{ "."\"account\": " .$json." " ." }";
        $json = json_decode($json);
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::POST,$id,$json,"addresses");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function changeAddresses($id, $params, $addressUUID)
    {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $attribute = "addresses/$addressUUID";
        $json = json_encode($params);
        $json = "{ \"account\": " . $json . " }";
        $json = json_decode($json);

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::PATCH, $id, $json, $attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function deleteAddress($id, $addressUUID) {
        $attribute= "addresses/$addressUUID";
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::DELETE,$id,[],$attribute);
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function getImage($id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::GET,$id,[],"image");
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }

    public function addImage($filePath, $id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        $data = [];

        if (file_exists($filePath)) {
            $mimeType = mime_content_type($filePath);
            $data['image'] = new \CURLFile($filePath, $mimeType, basename($filePath));
        } else {
            throw new Exception('File does not exist at the specified path.');
        }

        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT, AutoBillApiSchemeHelper::POST, $id, $data, 'image');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }
    public function deleteImage($id) {
        $requestBuilder = new AutoBillRequestBuilder($this->apiConfig->getAuthCredentialData());
        try {
            return $requestBuilder->callResourceAttribute(ApiResource::ACCOUNT,AutoBillApiSchemeHelper::DELETE,$id,[],'image');
        } catch (AutoBillApiException $e) {
            throw new AutoBillApiException($e->getMessage());
        }
    }



}
