<?php
namespace SamBurns\Pimple3ContainerInterop\Exception;

use Interop\Container\Exception\ContainerException as ContainerExceptionInterface;

class ContainerException extends \RuntimeException implements ContainerExceptionInterface
{

}
