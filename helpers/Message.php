<?php
namespace helpers;
session_start();
class Message{

    public static function message(string $name = '', string $message = '')
    {   
        if(isset($_SESSION[$name])){
            unset($_SESSION[$name]);
        }

            $_SESSION[$name] = $message;

    }

    public static function check(string $name): bool
    {
        if (isset($_SESSION[$name])) {
            return true;
        }else{
            return false;
        }
    }
}