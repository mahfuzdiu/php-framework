<?php

namespace Core;

class Response
{
    public function jsonResponse($data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        $response = [
            "status" => $statusCode,
            "data" => $data
        ];
        echo json_encode($response);
    }
}