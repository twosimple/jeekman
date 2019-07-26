<?php
namespace Destiny\Jeekman;

class Notify
{
    public function getParams($data)
    {
        $buff = '';
        foreach ($data as $k => $v) {
            $buff.=$k.'='.$v.'&';
        }
    }
}
