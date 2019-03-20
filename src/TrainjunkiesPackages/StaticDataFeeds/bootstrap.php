<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

require __DIR__ . '/../../../vendor/autoload.php';

// @codingStandardsIgnoreStart

try {
    (new Dotenv\Dotenv(__DIR__ . '/../../..'))->load();
}
catch (\Dotenv\Exception\InvalidPathException $e) {}

$container = new ContainerBuilder;
$loader = new PhpFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.php');

// @codingStandardsIgnoreEnd
