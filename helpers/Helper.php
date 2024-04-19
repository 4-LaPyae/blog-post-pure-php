<?php

namespace helpers;

use DateTime;
use DateTimeZone;

class Helper
{

    static function strToArr($str)

    {
        $newArr = explode(',', $str);
        return $newArr;
    }

    static function myanmartTime($time)
    {
        $utcDateTime = new DateTime($time, new DateTimeZone('UTC'));
        $utcDateTime->setTimezone(new DateTimeZone('Asia/Yangon')); // Setting the timezone to Myanmar Standard Time (UTC+6:30)

        $myanmarDateTime = $utcDateTime->format('Y-m-d H:i:s');
        return $myanmarDateTime;
    }
}
