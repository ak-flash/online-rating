<?php

namespace App\Helper;

class Helper
{
    public static function clearMask($input)
    {
        return preg_replace("/[^0-9]/", "", $input);
    }
}
