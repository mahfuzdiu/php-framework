<?php
namespace Core;

class Response
{
    function jsonResponse($result){
        echo json_encode($result);
    }
}