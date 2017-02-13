[![Build Status](https://travis-ci.org/Sam-Burns/pimple3-containerinterop.svg?branch=master)](https://travis-ci.org/Sam-Burns/pimple3-containerinterop)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Sam-Burns/pimple3-containerinterop/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Sam-Burns/pimple3-containerinterop/?branch=master)

Pimple3-ContainerInterop
========================

Introduction
------------

[Pimple 3](https://github.com/silexphp/Pimple) is a fast, lightweight, popular Dependency Injection container for PHP.  [ContainerInterop](https://github.com/container-interop/container-interop) is an open-source standard for interoperability between Dependency Injection containers.  This tool is a standards-compliant ContainerInterop wrapper for Pimple 3.

It works in PHP 5.5, 5.6 and 7.0.

User - Direct Pimple Access
---------------------------

The wrapper allows full access to all Pimple functionality, via a ```__call()``` method, and ```ArrayAccess```
implementation.  This allows you to call any method that exists in Pimple, directly on the wrapper.  You can also add
services using ```$container['service-id'] = //something```, as array access is supported.

Use - Service Retrieval
-----------------------

As per the standard, ```$container->has($serviceId)``` will tell you if a service is configured in the container.  ```$container->get($serviceId)``` will retrieve the service.  An implementation of ```Interop\Container\Exception\NotFoundException``` is thrown if you call ```get()``` and the service doesn't exist.  All other errors from Pimple result in an instance of ```Interop\Container\Exception\ContainerException``` being thrown.

Use - Installation
------------------
It is recommended to install this via [composer]:
```bash
composer require samburns/pimple3-containerinterop
```

Use - Configuration
-------------------

You can configure the Pimple container before wrapping it in a standards-compliant adapter:

```php
use Pimple\Container as PimpleContainer;
use SamBurns\Pimple3ContainerInterop\ServiceContainer;

$rawPimpleContainer = new PimpleContainer();
$rawPimpleContainer['service-id'] = function () {return new \Whatever();};
$container = ServiceContainer($rawPimpleContainer);
```

Or you can pass your own ```Pimple\ServiceProviderInterface``` implementions into the wrapper, to be applied to the inner Pimple container:

```php
use SamBurns\Pimple3ContainerInterop\ServiceContainer;
use My\ServiceProvider;

$container = new ServiceContainer();
$container->addConfig(new ServiceProvider());
```

There is even a named constructor you can use, if you want to spin up a ```ServiceContainer``` and configure it with a ```ServiceProviderInterface``` all in one line:

```php
use SamBurns\Pimple3ContainerInterop\ServiceContainer;
use My\ServiceProvider;

$container = ServiceContainer::constructConfiguredWith(new ServiceProvider());
```

Similar Projects
----------------

[PimpleInterop](https://github.com/moufmouf/pimple-interop) and [Acclimate](https://github.com/jeremeamia/acclimate-container) provide excellent alternatives if you don't like this library.  Although using Pimple v1 and not v3, they do offer the 'delegate lookup' feature described as optional in the standard, allowing you to combine multiple containers.

Contributions
-------------

Contributions welcome.  Fork the repo, make your changes, and create a pull request.  To run the tests, type ```./bin/test```.  PHPUnit integration tests and PHPSpec unit tests will run.

[composer]: https://getcomposer.org/
