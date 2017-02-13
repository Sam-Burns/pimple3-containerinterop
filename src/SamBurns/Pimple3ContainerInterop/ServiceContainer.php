<?php
namespace SamBurns\Pimple3ContainerInterop;

use Interop\Container\ContainerInterface;
use Pimple\Container as PimpleContainer;
use Pimple\ServiceProviderInterface;
use SamBurns\Pimple3ContainerInterop\Exception\ContainerException;
use SamBurns\Pimple3ContainerInterop\Exception\NotFoundException;
use Interop\Container\Exception\ContainerException as ContainerExceptionInterface;
use Interop\Container\Exception\NotFoundException as NotFoundExceptionInterface;

class ServiceContainer implements ContainerInterface, \ArrayAccess
{
    /** @var PimpleContainer */
    private $pimpleContainer;

    /**
     * @param PimpleContainer|null $pimpleContainer
     */
    public function __construct(PimpleContainer $pimpleContainer = null)
    {
        $this->pimpleContainer = $pimpleContainer ?: new PimpleContainer();
    }

    /**
     * @param ServiceProviderInterface $serviceProvider
     * @return ServiceContainer
     */
    public static function constructConfiguredWith(ServiceProviderInterface $serviceProvider)
    {
        $container = new static();
        $container->addConfig($serviceProvider);
        return $container;
    }

    /**
     * @param ServiceProviderInterface $pimpleServiceProvider
     */
    public function addConfig(ServiceProviderInterface $pimpleServiceProvider)
    {
        $this->pimpleContainer->register($pimpleServiceProvider);
    }

    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     *
     * @param string $serviceId
     * @return mixed
     */
    public function get($serviceId)
    {
        if (!$this->has($serviceId)) {
            throw NotFoundException::constructWithServiceId($serviceId);
        }
        try {
            return $this->pimpleContainer[$serviceId];
        } catch (\Exception $exception) {
            throw new ContainerException('Pimple container exception occurred', 0, $exception);
        }
    }

    /**
     * @param string $serviceId
     * @return bool
     */
    public function has($serviceId)
    {
        return isset($this->pimpleContainer[$serviceId]);
    }

    public function offsetGet($serviceId)
    {
        return $this->get($serviceId);
    }

    public function offsetExists($serviceId)
    {
        return $this->has($serviceId);
    }

    public function offsetUnset($serviceId)
    {
        $this->pimpleContainer->offsetUnset($serviceId);
    }

    public function offsetSet($serviceId, $value)
    {
        $this->pimpleContainer->offsetSet($serviceId, $value);
    }

    public function __call($name, $arguments)
    {
        call_user_func_array([$this->pimpleContainer, $name], $arguments);
    }
}
