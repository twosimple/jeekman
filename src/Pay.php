<?php
namespace yunqi\pay;

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
        $sysPubKey       = Functions::getKey($this->sysPubKey,1);
        $mercPriKey      = Functions::getKey($this->mercPriKey,0);
        $params['param'] = Functions::getEncrypt($sysPubKey,$this->data);
        $params['sign']  = Functions::getSign($mercPriKey,$this->data);
        return Functions::request($this->api,$params);
    }
}