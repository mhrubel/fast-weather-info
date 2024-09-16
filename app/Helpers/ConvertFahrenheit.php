<?php

namespace FastWeatherInfo\Helpers;

class ConvertFahrenheit
{
    public static function convertFahrenheit($celsius)
    {
        return ($celsius * 9 / 5) + 32;
    }
}
