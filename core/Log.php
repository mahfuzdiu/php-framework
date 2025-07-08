<?php
namespace Core;

class Log
{
    public static function debug($data){
        var_dump($data);
        exit;
    }
}