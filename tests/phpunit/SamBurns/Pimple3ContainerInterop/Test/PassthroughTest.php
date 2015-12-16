<?php
namespace SamBurns\Pimple3ContainerInterop\Test;

use SamBurns\Pimple3ContainerInterop\ServiceContainer;

class PassthroughTest extends \PHPUnit_Framework_TestCase
{
    public function testPassthroughWorks()
    {
        $pimpleContainer = $this->getMock('\Pimple\Container', [], [], '', false, false);

        $pimpleContainer
            ->expects($this->once())
            ->method('raw')
            ->with('service-id');

        $wrapper = new ServiceContainer($pimpleContainer);

        $wrapper->raw('service-id');
    }
}
