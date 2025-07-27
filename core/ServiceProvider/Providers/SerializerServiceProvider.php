<?php

namespace Core\ServiceProvider\Providers;

use Core\ServiceProvider\ContainerBuilderDefinition;
use Core\ServiceProvider\IServiceProviderRegister;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class SerializerServiceProvider implements IServiceProviderRegister
{
    public function register(): ContainerBuilderDefinition
    {
        return new ContainerBuilderDefinition(SerializerInterface::class, function () {
            $normalizers = [new ObjectNormalizer()];
            $encoders = [new JsonEncoder()];
            return new Serializer($normalizers, $encoders);
        });
    }
}