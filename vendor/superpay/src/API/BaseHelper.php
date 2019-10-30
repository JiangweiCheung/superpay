<?php
namespace SuperPay\API;
use  SuperPay\SDK\Traits\CurlTrait;
use  SuperPay\SDK\Traits\SignTrait;

abstract class BaseHelper
{
    protected $merchantId;
    protected $authenticationCode;
    protected $MD5ParameterString;

    protected $parameters;

    use SignTrait, CurlTrait;

    public function __construct(PayConfig $config)
    {
        $this->merchantId         = $config->getMerchantId();
        $this->authenticationCode = $config->getAuthenticationCode();
        $this->initMD5ParameterString();
    }

    protected function initMD5ParameterString()
    {
        $this->MD5ParameterString = 'merchant_id=';
        $this->MD5ParameterString .= $this->merchantId;
        $this->MD5ParameterString .= '&authentication_code=';
        $this->MD5ParameterString .= $this->authenticationCode;
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

    public function setMD5ParameterString($key, $value, bool $after = true)
    {
        if ($after) {
            $this->MD5ParameterString .= "&$key=$value";
        } else {
            $this->MD5ParameterString = "$key=$value&" . $this->MD5ParameterString;
        }
    }

    /**
     * 生成token
     * @param $params
     * @return string
     */
    public function generateToken()
    {
        $token = md5($this->MD5ParameterString);
 
        return $token;
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

    public function getCreateTime()
    {
        $DateTimeZone = new \DateTimeZone('GMT');
        $dateTime = new \DateTime('NOW', $DateTimeZone);
        return $dateTime->format('Y-m-d H:i:s');
    }

    public function buildRequest()
    {
        $this->setParameter('merchant_id', $this->merchantId);

        //接口不传商户验证码
        // $this->setParameter('authentication_code', $this->authenticationCode);

        $this->setParameter('token', $this->generateToken());
        $this->validate();

        return $this->parameters;
    }

    abstract public function validate();

    public function requestGet($url)
    {
        return $this->httpGet($url, $this->buildRequest());
    }

    public function getParameters()
    {
        return $this->parameters;
    }
}