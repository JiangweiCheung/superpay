<?php
namespace SuperPay\SDK;
use SuperPay\SDK\PayException;

class PayConfig
{
    private $mchId;
    private $receviceId;
    private $paySecretKey;

    public function __construct($mchId, $receviceId, $paySecretKey)
    {
        $this->mchId        = $mchId;
        $this->receviceId   = $receviceId;
        $this->paySecretKey = $paySecretKey;
        $this->validate();
    }

    public function getPaySecretKey()
    {
        return $this->paySecretKey;
    }

    public function getReceviceId()
    {
        return $this->receviceId;
    }

    public function getMchId()
    {
        return $this->mchId;
    }

    public function validate()
    {
        if (empty($this->receviceId)) {
            throw new PayException('receviceId不能为空');
        }

        if (empty($this->mchId)) {
            throw new PayException('receviceId不能为空');
        }

        if (empty($this->paySecretKey)) {
            throw new PayException('receviceId不能为空');
        }
    }
}