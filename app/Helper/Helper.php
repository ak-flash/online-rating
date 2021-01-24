<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

    public static function getRouteName(){
        $currentRouteName = Route::currentRouteName();
        return __(Str::ucfirst($currentRouteName));
    }

    // Get path for tailwind color
    public static function getMarkColor($mark){
        switch ($mark){
            case 0: $color = 'grey-400';
                break;
            case 2: $color = 'red-700';
                break;
            case 3: $color = 'green-500';
                break;
            case 4: $color = 'green-600';
                break;
            case 5: $color = 'green-700';
                break;
            default: $color = 'grey-500';
        }

        return $color;
    }

    public static function getShortName($name): string
    {
        $name = explode(' ', $name);

        $last_name = $name[0];
        $first_name = mb_substr($name[1], 0,1);
        $middle_name = mb_substr($name[2], 0,1);

        return $last_name.' '.$first_name.'. '.$middle_name.'.';
    }

    public static function getCourseNumber($semester)
    {
        return round($semester/2);
    }

    public static function getLinksArrayFromVOLGMED($linkId)
    {
        $links =array();

        $response = Http::get('https://www.volgmed.ru/ru/files/list/'.$linkId.'/');


        $openTag = "<tr><td class='GridTableBlue' width='18px;'><img src='https://www.volgmed.ru/templates/volgmu_pill/images/folder.gif' alt='Каталог' border='0'></td><td class='GridTableBlue'><a href='https://www.volgmed.ru/ru/files/list/";

        $closeTag = "</a>";

        $pattern = "#".$openTag."(.*?)".$closeTag."#";

        // Get all links Ids from volgmed.ru
        preg_match_all($pattern, $response->body(), $matches);

        foreach ($matches[1] as $match) {
            $links [] = [
                'id' => explode('/', $match)[0],
                'name' => explode('>', $match)[1]
            ];
        }
        return $links;
    }
}
