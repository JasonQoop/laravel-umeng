<?php


namespace Zzl\Umeng\Pusher;


use Zzl\Umeng\IOS\IOSBroadcast;
use Zzl\Umeng\IOS\IOSCustomizedcast;
use Zzl\Umeng\IOS\IOSFilecast;
use Zzl\Umeng\IOS\IOSGroupcast;
use Zzl\Umeng\IOS\IOSListcast;
use Zzl\Umeng\IOS\IOSUnicast;
use Log;
class IOSPusher extends Pusher
{

    /**
     * IOS广播
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendBroadcast($predefined= [], $customField= []) {
        $brocast = new IOSBroadcast();
        $brocast->setAppMasterSecret($this->appMasterSecret);
        $brocast->setPredefinedKeyValue("appkey",           $this->appKey);
        $brocast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        foreach ($predefined as $key => $val) {
            $brocast->setPredefinedKeyValue($key, $val);
        }

        $brocast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($customField as $key => $val) {
            $brocast->setCustomizedField($key, $val);
        }

        return $brocast->send();
    }

    /**
     * IOS单播
     * @param string $device_tokens
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendUnicast($device_tokens = '', $predefined= [], $customField= []) {
        $unicast = new IOSUnicast();
        $unicast->setAppMasterSecret($this->appMasterSecret);
        $unicast->setPredefinedKeyValue("appkey",           $this->appKey);
        $unicast->setPredefinedKeyValue("timestamp",        $this->timestamp);
        $unicast->setPredefinedKeyValue("device_tokens",   $device_tokens);

        foreach ($predefined as $key => $val) {
            $unicast->setPredefinedKeyValue($key, $val);
        }

        $unicast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($customField as $key => $val) {
            $unicast->setCustomizedField($key, $val);
        }
        return $unicast->send();
    }

    /**
     * IOS列播
     * @param string $device_tokens
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendListcast($device_tokens = '', $predefined= [], $customField= []) {
        $listcast = new IOSListcast();
        $listcast->setAppMasterSecret($this->appMasterSecret);
        $listcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $listcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
        $listcast->setPredefinedKeyValue("device_tokens",   $device_tokens);

        foreach ($predefined as $key => $val) {
            $listcast->setPredefinedKeyValue($key, $val);
        }

        $listcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($customField as $key => $val) {
            $listcast->setCustomizedField($key, $val);
        }
        return $listcast->send();
    }

    /** IOS文件播
     * @param string $fileContents
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendFilecast($fileContents = '', $predefined= [], $customField= []) {
        $filecast = new IOSFilecast();
        $filecast->setAppMasterSecret($this->appMasterSecret);
        $filecast->setPredefinedKeyValue("appkey",           $this->appKey);
        $filecast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        foreach ($predefined as $key => $val) {
            $filecast->setPredefinedKeyValue($key, $val);
        }

        $filecast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($customField as $key => $val) {
            $filecast->setCustomizedField($key, $val);
        }

        $filecast->uploadContents($fileContents);

        return $filecast->send();
    }

    /**IOS组播
     * @param array $filter
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendGroupcast($filter = [], $predefined= [], $customField= []) {
            $groupcast = new IOSGroupcast();
            $groupcast->setAppMasterSecret($this->appMasterSecret);
            $groupcast->setPredefinedKeyValue("appkey",           $this->appKey);
            $groupcast->setPredefinedKeyValue("timestamp",        $this->timestamp);
            // Set the filter condition
            $groupcast->setPredefinedKeyValue("filter",           $filter);

            foreach ($predefined as $key => $val) {
                $groupcast->setPredefinedKeyValue($key, $val);
            }

            $groupcast->setPredefinedKeyValue("production_mode", $this->production_mode);

            foreach ($customField as $key => $val) {
                $groupcast->setCustomizedField($key, $val);
            }

            return $groupcast->send();
    }

    /** IOS自定义播,通过alias
     * @param string $alias
     * @param string $alias_type
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendCustomizedcast($alias = '', $alias_type = '', $predefined= [], $customField= []) {
        $customizedcast = new IOSCustomizedcast();
        $customizedcast->setAppMasterSecret($this->appMasterSecret);
        $customizedcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        $customizedcast->setPredefinedKeyValue("alias", $alias);
        // Set your alias_type here
        $customizedcast->setPredefinedKeyValue("alias_type", $alias_type);

        foreach ($predefined as $key => $val) {
            $customizedcast->setPredefinedKeyValue($key, $val);
        }

        $customizedcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($customField as $key => $val) {
            $customizedcast->setCustomizedField($key, $val);
        }
        return $customizedcast->send();
    }

    /**
     * IOS自定义播,通过file_id
     * @param string $file_contents
     * @param array $predefined
     * @param array $customField
     * @return mixed
     * @throws \Zzl\Umeng\Exception\UmengException
     */
    public function sendCustomizedcastFileId($file_contents = '', $predefined= [], $customField = []) {
        $customizedcast = new IOSCustomizedcast();
        $customizedcast->setAppMasterSecret($this->appMasterSecret);
        $customizedcast->setPredefinedKeyValue("appkey",           $this->appKey);
        $customizedcast->setPredefinedKeyValue("timestamp",        $this->timestamp);

        $customizedcast->uploadContents($file_contents);

        foreach ($predefined as $key => $val) {
            $customizedcast->setPredefinedKeyValue($key, $val);
        }

        $customizedcast->setPredefinedKeyValue("production_mode", $this->production_mode);

        foreach ($customField as $key => $val) {
            $customizedcast->setCustomizedField($key, $val);
        }

        return $customizedcast->send();
    }
}
