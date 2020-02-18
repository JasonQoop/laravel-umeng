<?php
namespace pmcaff\Umeng\IOS;

use pmcaff\Umeng\IOSNotification;

class IOSListcast extends IOSNotification {
	function __construct() {
		parent::__construct();
		$this->data["type"] = "listcast";
		$this->data["device_tokens"] = NULL;
	}

}
