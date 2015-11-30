<?php
namespace SamBurns\Pimple3ContainerInterop\Dev;

use Pimple\ServiceProviderInterface;
use Pimple\Container as PimpleContainer;

class ExampleServiceProvider implements ServiceProviderInterface
{
    /**
     * @param PimpleContainer $container
     */
    public function register(PimpleContainer $container)
    {
        $container['example-service'] =
            function (PimpleContainer $container) {
                return new \stdClass();
            };
    }
}
