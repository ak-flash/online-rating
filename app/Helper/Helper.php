<?php

namespace App\Helper;

use Carbon\Carbon;

class Helper
{
    public static function clearMask($input)
    {
        return preg_replace("/[^0-9]/", "", $input);
    }

    public static function getTypeOfWeek($date = ''){
        return Carbon::parse($date)->format('W') % 2 === 0 ? 'чётная' : 'НЕчётная';
    }

    public static function formatDate($date = '', $format = 'Y-m-d'){
        return Carbon::parse($date)->format($format);
    }

    public static function formatDateForBase ($date = ''){
        return Carbon::createFromFormat('d/m/Y', $date);
    }
}
