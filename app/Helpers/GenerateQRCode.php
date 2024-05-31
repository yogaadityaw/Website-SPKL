<?php

namespace App\Helpers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class GenerateQRCode
{
    public static function generate($value)
    {
        try {
            return QrCode::size(100)->generate($value);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
