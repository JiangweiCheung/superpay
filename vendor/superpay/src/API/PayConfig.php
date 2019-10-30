<?php
namespace SuperPay\API;

class PayConfig
{
    private $merchantId;
    private $authenticationCode;

    public function __construct($merchantId, $authenticationCode)
    {
        $this->merchantId         = $merchantId;
        $this->authenticationCode = $authenticationCode;
        $this->validate();
    }

    public function getAuthenticationCode()
    {
        return $this->authenticationCode;
    }

    public function getMerchantId()
    {
        return $this->merchantId;
    }

    public function validate()
    {
        if (empty($this->merchantId)) {
            throw new PayException('merchantId不能为空');
        }

        if (empty($this->authenticationCode)) {
            throw new PayException('authenticationCode不能为空');
        }
    }
}