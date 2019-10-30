<?php
namespace SuperPay\API;

use SuperPay\API\BaseHelper;

class UnifiedOrder extends BaseHelper
{
    protected $alipayUrl = 'https://api.superpayglobal.com/payment/bridge/merchant_request';
    protected $wxpayUrl  = 'https://api.superpayglobal.com/payment/wxpayproxy/merchant_request';

    protected $result;

    public function getResult($url)
    {
        $this->setParameter('currency', 'AUD');
        $this->setParameter('create_time', $this->getCreateTime());
        $this->setParameter('merchant_validation_code', 'superpay');

        $this->setMD5ParameterString('merchant_trade_no', $this->parameters['merchant_trade_no'] ?? '');
        $this->setMD5ParameterString('total_amount', $this->parameters['total_amount'] ?? 0);

        $this->result = json_decode($this->requestGet($url), true);
        return $this->result;
    }

    public function validate()
    {
        if (null == $this->parameters["product_title"]) {
            throw new PayException("缺少统一支付接口必填参数product_title！" . "<br>");
        } 
        if (null == $this->parameters["merchant_trade_no"]) {
            throw new PayException("缺少统一支付接口必填参数merchant_trade_no！" . "<br>");
        } 
        if (null == $this->parameters["total_amount"] || $this->parameters["total_amount"] < 0.01) {
            throw new PayException("缺少统一支付接口必填参数total_amount！" . "<br>");
        }
        if (null == $this->parameters["create_time"]) {
            throw new PayException("缺少统一支付接口必填参数create_time！" . "<br>");
        }  
        if (null == $this->parameters["notification_url"]) {
            throw new PayException("缺少统一支付接口必填参数notification_url！" . "<br>");
        } 
        if (null == $this->parameters["token"]) {
            throw new PayException("缺少统一支付接口必填参数token！" . "<br>");
        } 
    }

    public function wxpay()
    {
        $url = $this->wxpayUrl;
        return $this->getResult($url);
    }

    public function alipay()
    {
        $this->setParameter('mobile_flag', 'T');
        $url = $this->alipayUrl;
        return $this->getResult($url);
    }

    public function getAlipayPrepareUrl()
    {
        $this->setParameter('currency', 'AUD');
        $this->setParameter('create_time', $this->getCreateTime());
        $this->setParameter('mobile_flag', 'T');
        $this->setParameter('merchant_validation_code', 'superpay');

        $this->setMD5ParameterString('merchant_trade_no', $this->parameters['merchant_trade_no'] ?? '');
        $this->setMD5ParameterString('total_amount', $this->parameters['total_amount'] ?? 0);
        
        return $this->buildURL($this->alipayUrl, $this->buildRequest());
    }
}