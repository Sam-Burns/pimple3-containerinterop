<?php
namespace SamBurns\Pimple3ContainerInterop\Test;

use Pimple\Container as PimpleContainer;
use SamBurns\Pimple3ContainerInterop\Dev\ExampleServiceProvider;
use SamBurns\Pimple3ContainerInterop\ServiceContainer;

class IntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testProvisioningContainerBeforeCreatingAdapter()
    {
        // ARRANGE

        // Create and configure raw Pimple container
        $rawContainer = new PimpleContainer();
        $serviceProvider = new ExampleServiceProvider();
        $rawContainer->register($serviceProvider);

        // Create standards-compliant container wrapper
        $containerWrapper = new ServiceContainer($rawContainer);

        // ACT
        $result = $containerWrapper->get('example-service');

        // ASSERT
        $this->assertInstanceOf('\stdClass', $result);
    }

    public function testProvisioningContainerWhileCreatingAdapter()
    {
        // ARRANGE

        // Create standards-compliant container wrapper and configure at the same time
        $containerWrapper = ServiceContainer::constructConfiguredWith(new ExampleServiceProvider());

        // ACT
        $result = $containerWrapper->get('example-service');

        // ASSERT
        $this->assertInstanceOf('\stdClass', $result);
    }

    public function testProvisioningContainerAfterCreatingAdapter()
    {
        // ARRANGE

        // Create standards-compliant container wrapper
        $containerWrapper = new ServiceContainer();

        // Configure container wrapper
        $containerWrapper->addConfig(new ExampleServiceProvider());

        // ACT
        $result = $containerWrapper->get('example-service');

        // ASSERT
        $this->assertInstanceOf('\stdClass', $result);
    }
}
