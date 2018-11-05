<?php

namespace App\Http\Controllers;


use Propaganistas\LaravelPhone\PhoneNumber;

class Tools
{

    public static function formatPhone($phone,$region)
    {
        $phone = str_replace(' ','',$phone);
        $region = strtoupper($region);
        if (PhoneNumber::make($phone,$region)->isOfCountry($region)) {
            return str_replace('+','',PhoneNumber::make($phone,$region)->formatE164());
        }
        return false;
    }
}
