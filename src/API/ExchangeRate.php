<?php
namespace SuperPay\API;

use SuperPay\API\BaseHelper;

class ExchangeRate extends BaseHelper
{
    protected $url = 'https://api.superpayglobal.com/payment/bridge/get_current_rate';

    protected $result;

    public function getResult()
    {
        $this->setParameter('currency', 'AUD');
        $this->setParameter('authentication_code', $this->authenticationCode);

        $this->setMD5ParameterString('currency', $this->parameters['currency']);
        $this->setMD5ParameterString('source', $this->parameters['source']);
        $this->result = $this->requestGet($this->url);
        return $this->result;
    }

    public function validate()
    {
        if (null == $this->parameters["currency"]) {
            throw new PayException("缺少统一支付接口必填参数currency！" . "<br>");
        } 
        if (null == $this->parameters["source"]) {
            throw new PayException("缺少统一支付接口必填参数source！" . "<br>");
        } 
        if (null == $this->parameters["token"]) {
            throw new PayException("缺少统一支付接口必填参数token！" . "<br>");
        } 
    }

    public function getWxExchangeRate()
    {
        $this->setParameter('source', 'W');
        return $this->getResult();
    }

    public function getAliExchangeRate()
    {
        $this->setParameter('source', 'A');
        return $this->getResult();
    }
}