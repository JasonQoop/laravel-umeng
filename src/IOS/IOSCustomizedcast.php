<?php
namespace Zzl\Umeng\IOS;

use Zzl\Umeng\IOSNotification;
use Zzl\Umeng\Exception\UmengException;
use Log;

class IOSCustomizedcast extends IOSNotification {

	function  __construct() {
		parent::__construct();
		$this->data["type"] = "customizedcast";
		$this->data["alias_type"] = NULL;
	}

	function isComplete() {
		parent::isComplete();
		if (!array_key_exists("alias", $this->data) && !array_key_exists("file_id", $this->data)){
			Log::error("Caught Umeng exception: You need to set alias or upload file for customizedcast!");
			throw new UmengException("You need to set alias or upload file for customizedcast!");
		}
	}

	// Upload file with device_tokens or alias to Umeng
	function uploadContents($content) {
		if ($this->data["appkey"] == NULL){
			Log::error("Caught Umeng exception: appkey should not be NULL!");
			throw new UmengException("appkey should not be NULL!");
		}
		if ($this->data["timestamp"] == NULL){
			Log::error("Caught Umeng exception: timestamp should not be NULL!");
			throw new UmengException("timestamp should not be NULL!");
		}
		if (!is_string($content)){
			Log::error("Caught Umeng exception: content should be a string!");
			throw new UmengException("content should be a string!");
		}

		$post = array("appkey"           => $this->data["appkey"],
					  "timestamp"        => $this->data["timestamp"],
					  "content"          => $content
					  );
		$url = $this->host . $this->uploadPath;
		$postBody = json_encode($post);
		$sign = md5("POST" . $url . $postBody . $this->appMasterSecret);
		$url = $url . "?sign=" . $sign;
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postBody);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErrNo = curl_errno($ch);
        $curlErr = curl_error($ch);
        curl_close($ch);
		$returnData = json_decode($result, TRUE);
        if ($httpCode == "0") {
			$errMsg = "Curl error number:" . $curlErrNo . " , Curl error details:" . $curlErr . "\r\n";
			Log::error("Caught Umeng exception: ". $errMsg);
			throw new UmengException($errMsg, 0);
		}
        else if ($httpCode != "200") {
			$errMsg = "http code:" . $httpCode . " details:" . $result . "\r\n";
			Log::error("Caught Umeng exception: ".$errMsg);
			throw new UmengException($errMsg, $httpCode, $returnData['data']['error_code']);
		}

        if ($returnData["ret"] == "FAIL"){
			$errMsg = "Failed to upload file, details:" . $result . "\r\n";
			Log::error("Caught Umeng exception: ".$errMsg);
			throw new UmengException($errMsg, $httpCode, $returnData['data']['error_code']);
		}
        else
        	$this->data["file_id"] = $returnData["data"]["file_id"];
	}


	function getFileId() {
		if (array_key_exists("file_id", $this->data))
			return $this->data["file_id"];
		return NULL;
	}
}
