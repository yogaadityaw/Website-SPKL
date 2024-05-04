<?php

namespace App\Helper;

use Carbon\Carbon;

class GenerateRandomSpklNumber
{
    public static function generate()
    {
        $timestamp = Carbon::now()->format('YmdH');
        return "PAL" . $timestamp . rand(000000, 999999);
    }
}
