<?php
namespace helpers;
class StrSlug
{

    public static function convert($str)
    { 
        // Convert to lowercase
        $lowercaseString = strtolower($str);
        
        // Replace spaces with underscores
        $underscoredString = str_replace(' ', '-', $lowercaseString);
        
        return $underscoredString;
        
    }
}
