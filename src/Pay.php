<?php
namespace yunqi\pay;

use yunqi\helper\encrypts\RSA;
use yunqi\helper\Funcs;
/**
 * 下单处理
 * @author destiny
 */
class Pay
{
    public $api; // 请求网关
    public $sysPubKey; // 系统公钥
    public $mercPriKey; // 商户私钥
    public $data; // 数据

    public function __construct($api,$sysPubKey,$mercPriKey,$data)
    {
        $this->api        = $api;
        $this->sysPubKey  = $sysPubKey;
        $this->mercPriKey = $mercPriKey;
        $this->data       = $data;
    }

    /**
     * 创建订单
     * @return void
     * @author destiny
     */
    public function order()
    {
        $params['param'] = RSA::Encrypt($this->sysPubKey,$this->data,1);
        $params['sign']  = RSA::Sign($this->mercPriKey,$this->data);
        return Funcs::post($this->api,$params);
    }
}