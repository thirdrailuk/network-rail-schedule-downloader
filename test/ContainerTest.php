<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ContainerTest
    extends \PHPUnit\Framework\TestCase
{
    private $container;

    protected function setUp()
    {
        $path = __DIR__ . '/../src/Trainjunkies/StaticDataFeeds';

        $this->container = new ContainerBuilder;
        $loader = new PhpFileLoader($this->container, new FileLocator($path));
        $loader->load('services.php');
    }

    /**
     * @test
     */
    function it_can_build_di_container()
    {
        foreach ($this->container->getServiceIds() as $serviceId) {
            $this->container->get($serviceId);
        }
    }
}