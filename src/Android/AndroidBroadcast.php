<?php
namespace pmcaff\Umeng\Android;

use pmcaff\Umeng\AndroidNotification;

class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}
