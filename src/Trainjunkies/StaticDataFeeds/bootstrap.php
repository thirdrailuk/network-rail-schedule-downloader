<?php

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

require __DIR__ . '/../../../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../../..');
$dotenv->load();

$container = new ContainerBuilder();
$loader = new PhpFileLoader($container, new FileLocator(__DIR__));
$loader->load('services.php');
