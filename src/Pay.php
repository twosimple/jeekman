<?php
namespace Destiny\Jeekman;

class Pay
{
    public $pubKey; // 加密param 系统公钥
    public $praKey; // 加密sign 商户私钥
    public $data; // 数据

    public function __construct($pubKey,$praKey,$data)
    {
        $this->pubKey = $pubKey;
        $this->praKey = $praKey;
        $this->data   = $data;
    }

    /**
     * 创建订单
     * @return void
     * @author destiny
     */
    protected function order()
    {
        // $key = openssl_pkey_get_public($this->pubKey);
        // if (!$key) 
        //     die('公钥不可用');
        // }
        // // $param = $this->praKey
        // // $this->praKey
        
        // // $this->data
    }
}