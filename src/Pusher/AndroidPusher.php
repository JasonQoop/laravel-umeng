<?php


namespace dali\Umeng\Pusher;


use dali\Umeng\Android\AndroidBroadcast;
use dali\Umeng\Android\AndroidCustomizedcast;
use dali\Umeng\Android\AndroidFilecast;
use dali\Umeng\Android\AndroidGroupcast;
use dali\Umeng\Android\AndroidListcast;
use dali\Umeng\Android\AndroidUnicast;
use Log;

class AndroidPusher extends Pusher
{

    /**
     * Android广播
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendBroadcast($predefined = [], $extraField = []) {
        $brocast = new AndroidBroadcast();

        $brocast->setAppMasterSecret($this->appMasterSecret);
        $brocast->setPredefinedKeyValue("appkey",           $this->appKey);
        $brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        foreach ($predefined as $key => $val) {
            $brocast->setPredefinedKeyValue($key, $val);
        }
        $brocast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $brocast->setExtraField($key, $val);
        }

        return $brocast->send();

    }

    /**
     * Android单播
     * @param string $device_tokens
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendUnicast($device_tokens = '', $predefined= [], $extraField = []) {
        $unicast = new AndroidUnicast();
        $unicast->setAppMasterSecret($this->appMasterSecret);
        $unicast->setPredefinedKeyValue("appkey",           $this->appKey);
        $unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);
        $unicast->setPredefinedKeyValue("device_tokens",    $device_tokens);

        foreach ($predefined as $key => $val) {
            $unicast->setPredefinedKeyValue($key, $val);
        }
        $unicast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $unicast->setExtraField($key, $val);
        }

        return $unicast->send();

    }

    /**
     * Android列播
     * @param string $device_tokens
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendListcast($device_tokens = '', $predefined= [], $extraField = []){
        $listcast = new AndroidListcast();
        $listcast->setAppMasterSecret($this->appMasterSecret);
        $listcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $listcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
        $listcast->setPredefinedKeyValue("device_tokens",    $device_tokens);

        foreach ($predefined as $key => $val) {
            $listcast->setPredefinedKeyValue($key, $val);
        }
        $listcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $listcast->setExtraField($key, $val);
        }

        return $listcast->send();

    }

    /**
     * Android文件播
     * @param string $fileContents
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendFilecast($fileContents = '', $predefined= [],$extraField = []) {
        $filecast = new AndroidFilecast();
        $filecast->setAppMasterSecret($this->appMasterSecret);
        $filecast->setPredefinedKeyValue("appkey",           $this->appKey);
        $filecast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        foreach ($predefined as $key => $val) {
            $filecast->setPredefinedKeyValue($key, $val);
        }

        $filecast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $filecast->setExtraField($key, $val);
        }
        $filecast->uploadContents($fileContents);

        return $filecast->send();

    }

    /**
     * Android组播
     * @param array $filter
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendGroupcast($filter = [], $predefined= [], $extraField = []) {
        $groupcast = new AndroidGroupcast();
        $groupcast->setAppMasterSecret($this->appMasterSecret);
        $groupcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $groupcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        $groupcast->setPredefinedKeyValue("filter",           $filter);

        foreach ($predefined as $key => $val) {
            $groupcast->setPredefinedKeyValue($key, $val);
        }

        $groupcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $groupcast->setExtraField($key, $val);
        }
        return $groupcast->send();
    }

    /**
     *  Android自定义播,通过alias
     * @param string $alias
     * @param string $alias_type
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendCustomizedcast($alias = '', $alias_type = '', $predefined= [], $extraField = []) {
        $customizedcast = new AndroidCustomizedcast();
        $customizedcast->setAppMasterSecret($this->appMasterSecret);
        $customizedcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        $customizedcast->setPredefinedKeyValue("alias",            $alias);
        $customizedcast->setPredefinedKeyValue("alias_type",       $alias_type);

        foreach ($predefined as $key => $val) {
            $customizedcast->setPredefinedKeyValue($key, $val);
        }

        $customizedcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $customizedcast->setExtraField($key, $val);
        }

        return $customizedcast->send();
    }

    /**
     * Android自定义播,通过file_id
     * @param string $file_contents
     * @param array $predefined
     * @param array $extraField
     * @return mixed
     * @throws \dali\Umeng\Exception\UmengException
     */
    public function sendCustomizedcastFileId($file_contents = '', $predefined= [], $extraField = []) {
        $customizedcast = new AndroidCustomizedcast();
        $customizedcast->setAppMasterSecret($this->appMasterSecret);
        $customizedcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        $customizedcast->uploadContents($file_contents);

        foreach ($predefined as $key => $val) {
            $customizedcast->setPredefinedKeyValue($key, $val);
        }

        $customizedcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($extraField as $key => $val) {
            $customizedcast->setExtraField($key, $val);
        }

        return $customizedcast->send();
    }
}
