<?php
namespace SuperPay\API;

use SuperPay\API\BaseHelper;

class PayNotify extends BaseHelper
{
    protected $url = 'https://api.superpayglobal.com/payment/bridge/notification_verification';

    protected $result;

    public function validate()
    {
        if (null == $this->parameters["notice_id"]) {
            throw new PayException("缺少统一支付接口必填参数notice_id！" . "<br>");
        } 
        if (null == $this->parameters["token"]) {
            throw new PayException("缺少统一支付接口必填参数token！" . "<br>");
        } 
    }

    public function verify($result)
    {
        $this->setParameter('notice_id', $result['notice_id']);
        $this->setParameter('merchant_trade_no', $result['merchant_trade_no']);

        $this->result = $this->httpGet($this->url, $this->parameters);

        return $this->result;
    }

    public function verifyToken($result)
    { 
        $md5String = 'notice_id=' . $result['notice_id'];
        $md5String .= 'merchant_trade_no=' . $result['merchant_trade_no'];
        $md5String .= 'authentication_code=' . $this->authenticationCode;

        $token = md5($md5String);
        
        return $token === $result['token'];
    }
}