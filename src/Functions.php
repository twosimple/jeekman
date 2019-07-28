<?php
namespace yunqi\pay;

/**
 * funcitions
 *
 * @author destiny
 */
class Functions
{
    /**
     * 发起下单请求
     * @param [type] $params
     * @return void
     * @author destiny
     */
    public static function request($url,$params)
    {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //开启发送post请求选项
        curl_setopt($ch,CURLOPT_POST,true);
        //发送post的数据
        curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
        $result = curl_exec($ch);
        //4.返回返回值，关闭连接
        curl_close($ch);
        return $result;
    }

    /**
     * 获取/检查密钥合法性
     * @return void
     * @author destiny
     */
    public static function getKey($key,$type)
    {
        $key = $type?openssl_pkey_get_public($key):openssl_pkey_get_private($key);
        if(!$key){
            throw new \Exception("密钥无法使用", 203);
        }
        return $key;
    }

    /**
     * 加密数据
     * @param [type] $data
     * @return void
     * @author destiny
     */
    public static function getEncrypt($key,$data)
    {
        $dataStr = json_encode($data);
        // 分段加密
        $encrypt = '';
        foreach (str_split($dataStr, 117) as $chunk)
        {
            openssl_public_encrypt($chunk,$encryptData,$key);
            $encrypt .= $encryptData;
        }
        openssl_free_key($key);
        return $encrypt;
    }

    /**
     * 签名
     * @param [type] $key
     * @param [type] $data
     * @param string $signType
     * @return void
     * @author destiny
     */
    public static function getSign($key,$data)
    {
        $buff = self::getBuff($data);
        openssl_sign($buff, $sign,$key);
        openssl_free_key($key);
        return $sign;
    }

    /**
     * 操作数组转换成字符串
     * @param [type] $data
     * @return void
     * @author destiny
     */
    private static function getBuff($data)
    {
        ksort($data);
        $buff = '';
        foreach ($data as $k => $v) {
            $buff.=$k.'='.$v.'&';
        }
        return trim($buff,'&');
    }
}
