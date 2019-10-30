<?php
namespace SuperPay\SDK;

use SuperPay\SDK\BaseHelper;

abstract class TradeHelper extends BaseHelper
{
    protected $url = 'https://gate.supaytechnology.com/api/gateway/merchant/order';
    protected $data;
    protected $result;

    public function getResult()
    {
        $this->result = $this->postJson($this->url);
        return $this->result;
    }

    public function getData()
    {
        $this->data = isset($this->result['data']) ? $this->result['data'] : null;
        return $this->data; 
    }

    public function getStatus()
    {
        return isset($this->result['status']) ? $this->result['status'] : null;
    }

    public function getMessage()
    {
        return isset($this->result['message']) ? $this->result['message'] : null;
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}