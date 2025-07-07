<?php
namespace Core;

class Log
{
    public static function debug($data){
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit;
    }
}