<?php
namespace Zzl\Umeng\IOS;

use Zzl\Umeng\IOSNotification;

class IOSBroadcast extends IOSNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}
