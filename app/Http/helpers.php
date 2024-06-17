<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $output = 'active')
    {
        return Route::currentRouteName() == $route ? $output : '';
    }
}

if (!function_exists('isActiveUrl')) {
    function isActiveUrl($url, $output = 'active')
    {
        return request()->is($url) ? $output : '';
    }
}
