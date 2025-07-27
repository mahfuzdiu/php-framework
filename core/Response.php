<?php

namespace Core;

use Symfony\Component\Serializer\SerializerInterface;

class Response
{
    public function __construct(private SerializerInterface $serializer){}

    public function jsonResponse($data, int $statusCode = 200): void
    {
        if(is_object($data) || is_array($data)){
            $data = $this->serializer->normalize($data);
        }

        http_response_code($statusCode);
        $response = [
            "status" => $statusCode,
            "data" => $data
        ];
        echo json_encode($response);
    }
}