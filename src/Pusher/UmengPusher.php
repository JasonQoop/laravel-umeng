<?php

namespace pmcaff\Umeng\Pusher;

class UmengPusher
{
    private $android = null;
    private $ios = null;
    public function __construct() {
        $iosAppKey = config('umeng.ios_app_key');
        $iosAppMasterSecret = config('umeng.ios_app_master_secret');
        $androidAppKey = config('umeng.android_app_key');
        $androidAppMasterSecret = config('umeng.android_app_master_secret');

        $this->android = new AndroidPusher($androidAppKey, $androidAppMasterSecret);
        $this->ios = new IOSPusher($iosAppKey, $iosAppMasterSecret);
    }

    public function android(){
        return $this->android;
    }

    public function ios(){
        return $this->ios;
    }
}
