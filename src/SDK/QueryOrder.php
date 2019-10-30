<?php
namespace SuperPay\SDK;

use SuperPay\SDK\TradeHelper;
use SuperPay\SDK\PayException;

class QueryOrder extends TradeHelper
{
    public function __construct(PayConfig $config)
    {
        parent::__construct($config);
        $this->setService(SuperPayConfig::SERVICE_QUERY_TRADE);
    }

    public function validate()
    {
        if (null == $this->parameters["mch_order_no"]) {
            throw new PayException("缺少统一支付接口必填参数mch_order_no！" . "<br>");
        } 
        if (null == $this->parameters["mch_id"]) {
            throw new PayException("缺少统一支付接口必填参数mch_id！" . "<br>");
        } 
        if (null == $this->parameters["trade_type"]) {
            throw new PayException("缺少统一支付接口必填参数trade_type！" . "<br>");
        }  
    }
}