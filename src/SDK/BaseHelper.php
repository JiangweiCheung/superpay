<?php
namespace SuperPay\SDK;
use  SuperPay\SDK\Traits\CurlTrait;
use  SuperPay\SDK\Traits\SignTrait;
use  SuperPay\SDK\SuperPayConfig;

abstract class BaseHelper
{
    protected $service;
    protected $mchId;
    protected $parameters;
    protected $receviceId;
    protected $paySecretKey;
    protected $superPayConfig;

    use SignTrait, CurlTrait;

    public function __construct(PayConfig $config)
    {
        $this->mchId          = $config->getMchId();
        $this->receviceId     = $config->getReceviceId();
        $this->paySecretKey   = $config->getPaySecretKey();
        $this->superPayConfig = new SuperPayConfig;
    }

    protected function trimString($value)
    {
        $ret = null;
        if (null != $value) {
            $ret = $value;
            if (strlen($ret) == 0) {
                $ret = null;
            }
        }

        return $ret;
    }

    /**
     * 生成签名
     * @param $params
     * @return string
     */
    protected function getSign($params)
    {
        foreach ($params as $k => $v) {
            $parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        $signString = $this->formatBizQueryParaMap($parameters, false);

        //签名步骤二：在string后加入KEY
        $signString = $signString . "&key=" . $this->paySecretKey;

        //签名步骤三：MD5加密
        $signString = md5($signString);

        //签名步骤四：所有字符转为大写
        $result = strtoupper($signString);
        //echo "【result】 ".$result."</br>";

        return $result;
    }

    /**
     *响应验签
     * @param $params
     * @return string
     */
    public function checkSign($data)
    {
        $pre_sign = $data['sign'];
        unset($data['sign']);
        unset($data['sign_type']);
        $sign = $this->getSign($data); //本地签名

        if ($pre_sign == $sign) {
            return true;
        }

        return false;
    }

    /**
     * 设置请求参数
     * @param $parameter
     * @param $parameterValue
     */
    public function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    public function buildRequest()
    {
        $this->setParameter('service', $this->service);
        $this->setParameter('mch_id', $this->mchId);
        $this->setParameter('recevice_id', $this->receviceId);
        $this->setParameter('charset', $this->superPayConfig->charset);
        $this->setParameter('version', $this->superPayConfig->version);
        $this->setParameter('sign', $this->getSign($this->parameters));
        $this->setParameter('sign_type', $this->superPayConfig->sign_type);

        $this->validate();

        return $this->parameters;
    }

    abstract public function validate();

    public function postJson($url)
    {
        return $this->httpPostJson($url, $this->buildRequest());
    }
}