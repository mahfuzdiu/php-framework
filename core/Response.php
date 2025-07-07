<?php
namespace Core;

class Response
{
    function jsonResponse($result){
        return json_encode($result);
    }
}