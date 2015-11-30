<?php
namespace SamBurnsSpec\SamBurns\Pimple3ContainerInterop\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initialisable()
    {
        $this->shouldHaveType('SamBurns\Pimple3ContainerInterop\Exception\NotFoundException');
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType('\Exception');
    }

    function it_is_standards_compliant()
    {
        $this->shouldHaveType('\Interop\Container\Exception\NotFoundException');
    }
}
