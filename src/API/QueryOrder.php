<?php
namespace SuperPay\API;

use SuperPay\API\BaseHelper;

class QueryOrder extends BaseHelper
{
    protected $resultUrl = 'https://api.superpayglobal.com/payment/bridge/get_payment_result';
    protected $detailUrl = 'https://api.superpayglobal.com/payment/bridge/get_payment_detail';

    protected $result;

    public function getResult($url)
    {
        $this->result = $this->requestGet($url);
        return $this->result;
    }

    public function validate()
    {
        if (null == $this->parameters["merchant_trade_no"]) {
            throw new PayException("缺少统一支付接口必填参数merchant_trade_no！" . "<br>");
        } 
        if (null == $this->parameters["token"]) {
            throw new PayException("缺少统一支付接口必填参数token！" . "<br>");
        } 
    }

    public function getPaymentResult($merchant_trade_no)
    {
        $this->setParameter('merchant_trade_no', $merchant_trade_no);
        $this->setMD5ParameterString('merchant_trade_no', $merchant_trade_no);

        return $this->getResult($this->resultUrl);
    }

    public function getPaymentDetail($merchant_trade_no)
    {
        $this->setParameter('merchant_trade_no', $merchant_trade_no);
        $this->setMD5ParameterString('merchant_trade_no', $merchant_trade_no);

        return $this->getResult($this->detailUrl);
    }

}