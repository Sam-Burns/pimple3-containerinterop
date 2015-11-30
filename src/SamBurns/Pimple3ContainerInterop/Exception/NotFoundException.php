<?php
namespace SamBurns\Pimple3ContainerInterop\Exception;

use Interop\Container\Exception\NotFoundException as NotFoundExceptionInterface;

class NotFoundException extends ContainerException implements NotFoundExceptionInterface
{
    /**
     * @param string $serviceId
     * @return NotFoundException
     */
    public static function constructWithServiceId($serviceId)
    {
        return new static("Service '$serviceId' not found in DI container");
    }
}
