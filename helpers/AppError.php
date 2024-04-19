<?php
namespace helpers;
class AppError
{

    static function Msg()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');
    }
}
