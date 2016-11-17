<?php
namespace Zzl\Umeng\Android;

use Zzl\Umeng\AndroidNotification;

class AndroidBroadcast extends AndroidNotification {
	function  __construct() {
		parent::__construct();
		$this->data["type"] = "broadcast";
	}
}
