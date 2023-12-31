<?php
   class Response {
      private $success;
      private $httpStatusCode;
      private $message = [];
      private $data;
      private $toCache = false;
      private $responseData = [];
      public function setSuccess($success) {
         $this->success = $success;
      }
      public function setHttpStatusCode($httpStatusCode) {
         $this->httpStatusCode = $httpStatusCode;
      }
      public function setMessage($message) {
         $this->message[] = $message;
      }
      public function setData($data) {
         $this->data = $data;
      }   
      public function setToCache($toCache) {
         $this->toCache = $toCache;
      }
      public function setResponseData($responseData) {
         $this->responseData = $responseData;
      }
      public function send() {
         header("Content-type: application/json; charset=utf-8");
         if($this->toCache === true) {
            header("Cache-control : max-age=60");
         }else {
            header("Cache-control : no-cache, no-store");
         }
         if($this->success !== true && $this->success !== false || !is_numeric($this->httpStatusCode)) {
            http_response_code(500);
            $this->responseData['statusCode'] = 500;
            $this->responseData["success"] = false;
            $this->setMessage("Response creation error");
            $this->responseData['messages'] = $this->message;
         }else 
         {
            http_response_code($this->httpStatusCode);
            $this->responseData['statusCode'] = $this->httpStatusCode;
            $this->responseData['success'] = $this->success;
            $this->responseData['messages'] = $this->message;
            $this->responseData['data'] = $this->data;
         }
         echo json_encode($this->responseData);
      }
   }
?>