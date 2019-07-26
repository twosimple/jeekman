<?php
namespace Destiny\Jeekman;

class Functions
{
    public function getParams($data)
    {
        $buff = '';
        foreach ($data as $k => $v) {
            $buff.=$k.'='.$v.'&';
        }
    }
}
