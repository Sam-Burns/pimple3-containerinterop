<?php
namespace SamBurnsSpec\SamBurns\Pimple3ContainerInterop\Exception;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('\SamBurns\Pimple3ContainerInterop\Exception\ContainerException');
    }

    function it_is_an_exception()
    {
        $this->shouldHaveType('\Exception');
    }

    function it_is_standards_compliant()
    {
        $this->shouldHaveType('\Interop\Container\Exception\ContainerException');
    }
}
