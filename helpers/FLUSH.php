<?php
namespace helpers;
class FLUSH
{
    const FLASH = 'FLASH_MESSAGES';

    private function create_flash_message(string $name, string $message): void
    {
        // remove existing message with the name
        if (isset($_SESSION[self::FLASH][$name])) {
            unset($_SESSION[self::FLASH][$name]);
        }
        // add the message to the session
        $_SESSION[self::FLASH][$name] = $message;
    }

    private function display_flash_message(string $name): string
    {
        if (!isset($_SESSION[self::FLASH][$name])) {
            return '';
        }

        // get message from the session
        $flash_message = $_SESSION[self::FLASH][$name];

        // delete the flash message
        unset($_SESSION[self::FLASH][$name]);

        // display the flash message
        return $flash_message;
    }

    public static function message(string $name = '', string $message = ''): string
    {   
        $instanst = new self();

        if ($name !== '' && $message !== '') {
            // create a flash message
            $instanst->create_flash_message($name, $message);
            return '';
        } elseif ($name !== '' && $message === '') {
            // display a flash message
            return $instanst->display_flash_message($name);
        }
    }

    public static function check(string $name): bool
    {
        if (isset($_SESSION[self::FLASH][$name])) {
            return true;
        }else{
            return false;
        }
    }
}