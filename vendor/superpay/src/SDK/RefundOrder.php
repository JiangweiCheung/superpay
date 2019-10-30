<?php
namespace SuperPay\SDK;

use SuperPay\SDK\TradeHelper;
use SuperPay\SDK\PayException;

class RefundOrder extends TradeHelper
{
    public function __construct(PayConfig $config)
    {
        parent::__construct($config);
        $this->setService(SuperPayConfig::SERVICE_CREATE_REFUND);
    }

    public function validate()
    {
        if (null == $this->parameters["mch_order_no"]) {
            throw new PayException("缺少统一支付接口必填参数mch_order_no！" . "<br>");
        } 
        if (null == $this->parameters["mch_id"]) {
            throw new PayException("缺少统一支付接口必填参数mch_id！" . "<br>");
        } 
        if (null == $this->parameters["call_back_url"]) {
            throw new PayException("缺少统一支付接口必填参数call_back_url！" . "<br>");
        } 
        if (null == $this->parameters["orig_mch_order_no"]) {
            throw new PayException("缺少统一支付接口必填参数orig_mch_order_no！" . "<br>");
        } 
        if (null == $this->parameters["refund_amount"]) {
            throw new PayException("缺少统一支付接口必填参数refund_amount！" . "<br>");
        }  
    }
}