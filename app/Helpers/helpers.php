<?php

if (!function_exists('fa_digits')) {
    function fa_digits($value)
    {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        return str_replace($english, $persian, $value);
    }
}

if (!function_exists('toman')) {
    function toman($value)
    {
        return fa_digits(number_format($value)) . ' تومان';
    }
}
