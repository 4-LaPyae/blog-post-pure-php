<?php

namespace helpers;

class AUTH
{
    static function check($name)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else if($name == 'admin'){
            HTTP::redirect("/admin/login.php");
        }else{
            HTTP::redirect("/login.php");
        }
    }
    static function valid($name)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION[$name])) {
            return true;
        } else {
            return false;
        }
    }
}
