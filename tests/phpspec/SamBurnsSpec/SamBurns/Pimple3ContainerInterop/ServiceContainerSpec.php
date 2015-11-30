<?php
namespace SamBurnsSpec\SamBurns\Pimple3ContainerInterop;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Pimple\Container as PimpleContainer;
use SamBurns\Pimple3ContainerInterop\ServiceContainer;

/**
 * @mixin ServiceContainer
 */
class ServiceContainerSpec extends ObjectBehavior
{
    function let(PimpleContainer $pimpleContainer)
    {
        $this->beConstructedWith($pimpleContainer);
    }

    function it_is_initialisable()
    {
        $this->shouldHaveType('SamBurns\Pimple3ContainerInterop\ServiceContainer');
    }

    function it_is_standards_compliant()
    {
        $this->shouldHaveType('\Interop\Container\ContainerInterface');
    }

    function it_can_get_things(PimpleContainer $pimpleContainer, \stdClass $exampleService)
    {
        $pimpleContainer->offsetExists('service-id')->willReturn(true);
        $pimpleContainer->offsetGet('service-id')->willReturn($exampleService);
        $this->get('service-id')->shouldReturn($exampleService);
    }

    function it_can_tell_if_it_has_something(PimpleContainer $pimpleContainer)
    {
        $pimpleContainer->offsetExists('service-id')->willReturn(true);
        $this->has('service-id')->shouldReturn(true);
    }

    function it_can_throw_a_not_found_exception(PimpleContainer $pimpleContainer)
    {
        $pimpleContainer->offsetExists('service-id')->willReturn(false);
        $this->shouldThrow('\Interop\Container\Exception\NotFoundException')->during('get', ['service-id']);
    }

    function it_can_recast_exceptions_from_pimple(PimpleContainer $pimpleContainer)
    {
        $pimpleContainer->offsetExists('service-id')->willReturn(true);
        $pimpleContainer->offsetGet('service-id')->willThrow('\Exception');
        $this->shouldThrow('\Interop\Container\Exception\ContainerException')->during('get', ['service-id']);
    }
}
