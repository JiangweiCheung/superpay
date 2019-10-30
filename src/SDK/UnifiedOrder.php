<?php
namespace SuperPay\SDK;

use SuperPay\SDK\TradeHelper;
use SuperPay\SDK\PayException;
use SuperPay\SDK\SuperPayConfig;

class UnifiedOrder extends TradeHelper
{
    public function __construct(PayConfig $config)
    {
        parent::__construct($config);
        $this->setService(SuperPayConfig::SERVICE_CREATE_INSTANT_TRADE);
    }

    public function validate()
    {
        if (null == $this->parameters["mch_order_no"]) {
            throw new PayException("缺少统一支付接口必填参数mch_order_no！" . "<br>");
        } 
        if (null == $this->parameters["mch_id"]) {
            throw new PayException("缺少统一支付接口必填参数mch_id！" . "<br>");
        } 
        if (null == $this->parameters["recevice_id"]) {
            throw new PayException("缺少统一支付接口必填参数recevice_id！" . "<br>");
        }
        if (null == $this->parameters["store_name"]) {
            throw new PayException("缺少统一支付接口必填参数store_name！" . "<br>");
        }  
        if (null == $this->parameters["call_back_url"]) {
            throw new PayException("缺少统一支付接口必填参数call_back_url！" . "<br>");
        } 
        if (null == $this->parameters["pay_amount"]) {
            throw new PayException("缺少统一支付接口必填参数pay_amount！" . "<br>");
        } 
        if (null == $this->parameters["goods_name"]) {
            throw new PayException("缺少统一支付接口必填参数goods_name！" . "<br>");
        }
        if (null == $this->parameters["goods_price"]) {
            throw new PayException("缺少统一支付接口必填参数goods_price！" . "<br>");
        } 
        if (null == $this->parameters["timeout_express"]) {
            throw new PayException("缺少统一支付接口必填参数timeout_express！" . "<br>");
        }  
        if ("JSAPI" == $this->parameters["pay_way"] && null == $this->parameters["subOpenId"]) {
            throw new PayException("统一支付接口中，缺少必填参数subOpenId！pay_way为JSAPI时，subOpenId为必填参数！" . "<br>");
        }
    }

    public function getJsPayParameters($prepayId)
    {
        $jsApiObj["appId"]     = $this->appId;
        $timeStamp             = time();
        $jsApiObj["timeStamp"] = "$timeStamp";
        $jsApiObj["nonceStr"]  = $this->createNoncestr();
        $jsApiObj["package"]   = "prepay_id=$prepayId";
        $jsApiObj["signType"]  = "MD5";
        $jsApiObj["paySign"]   = $this->getSign($jsApiObj);

        return $jsApiObj;
    }
 
}