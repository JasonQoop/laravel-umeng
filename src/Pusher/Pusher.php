<?php


namespace pmcaff\Umeng\Pusher;


class Pusher
{
    protected $appKey = null;
    protected $appMasterSecret = null;
    protected $timestamp = null;
    protected $production_mode = false;


    public function __construct($appKey, $masterSecret){
        $this->appKey = $appKey;
        $this->appMasterSecret = $masterSecret;
        $this->timestamp = strval(time());
        $this->production_mode = config('umeng.production_mode');
    }
}
