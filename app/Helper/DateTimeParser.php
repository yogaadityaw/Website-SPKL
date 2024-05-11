<?php

namespace App\Helper;

use Carbon\Carbon;

class DateTimeParser
{
    public static function parse(?string $timestamp, string $format = 'l, j F Y'): string
    {
        if ($timestamp == null) {
            return "";
        }

        return Carbon::parse($timestamp)->translatedFormat($format);
    }
}
