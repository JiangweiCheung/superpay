<?php
namespace SuperPay\SDK;

class SuperPayConfig{
    //编码类型
    public $charset = 'UTF-8';

    //签名类型
    public $sign_type = 'MD5';

    //版本
    public $version = '1.0';

    //支付方式
    /**
     * 支付方式（SDK，JSAPI，PC，H5）
     * channel为空时，只能选择PC 或者 H5，此时返回的pay_info为收银台的URL
     */
    public $pay_way = 'SDK';

    //支付渠道
    /**
     * WXPAY 或者 ALIPAY
     */
    // public $pay_channel = '';

    //预下单服务
    const SERVICE_CREATE_INSTANT_TRADE = 'create_instant_trade';

    //退款服务
    const SERVICE_CREATE_REFUND = 'create_refund';

    //查询交易单服务
    const SERVICE_QUERY_TRADE = 'query_trade';

    //获取openid服务
    const SERVICE_WX_JSAPI_OPENID ='wx_jsapi_openid';

    //下载对账单服务
    const SERVICE_DOWNLOAD_COMPARE_FILE ='download_compare_file';

    //下载结账单服务
    const SERVICE_DOWNLOAD_LIQUIDATION_FILE = 'download_liquidation_file';
}
