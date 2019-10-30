<?php
namespace SuperPay\API;

use SuperPay\API\BaseHelper;

class RefundOrder extends BaseHelper
{
    protected $url = 'https://api.superpayglobal.com/payment/bridge/refund';

    protected $result;

    public function getResult()
    {
        $this->setMD5ParameterString('merchant_trade_no', $this->parameters['merchant_trade_no'] ?? '');
        $this->setMD5ParameterString('org_merchant_trade_no', $this->parameters['org_merchant_trade_no'] ?? '');
        $this->setMD5ParameterString('total_amount', $this->parameters['total_amount'] ?? 0);

        $this->result = json_decode($this->requestGet($this->url), true);
        return $this->result;
    }

    public function validate()
    {
        if (null == $this->parameters["org_merchant_trade_no"]) {
            throw new PayException("缺少统一支付接口必填参数org_merchant_trade_no！" . "<br>");
        } 
        if (null == $this->parameters["merchant_trade_no"]) {
            throw new PayException("缺少统一支付接口必填参数merchant_trade_no！" . "<br>");
        } 
        if (null == $this->parameters["token"]) {
            throw new PayException("缺少统一支付接口必填参数token！" . "<br>");
        } 
    }

}