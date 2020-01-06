<?php

namespace dali\Umeng\Exception;

use Exception;

class UmengException extends Exception
{
    protected $httpCode;
    protected $errCode;

    public function __construct($message, $httpCode = 200, $errCode = 0)
    {
        parent::__construct($message);
        $this->httpCode = $httpCode;
        $this->errCode = $errCode;
    }

    public function getHttpCode(){
        return $this->httpCode;
    }

    public function getErrCode(){
        return $this->errCode;
    }
}