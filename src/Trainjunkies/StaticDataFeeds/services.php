<?php

use Symfony\Component\DependencyInjection\Reference;

// @codingStandardsIgnoreStart

try {
    $authentication = \Trainjunkies\StaticDataFeeds\NetworkRail\Authentication::fromUsernameAndPassword(
        getenv('TRAINJUNKIES_NETWORKRAIL_USERNAME'),
        getenv('TRAINJUNKIES_NETWORKRAIL_PASSWORD')
    );
}
catch (Exception $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
}

// Services
$container->register('http.adapter.guzzle', \Trainjunkies\StaticDataFeeds\Http\GuzzleAdapter::class)
    ->addArgument($authentication)
    ->addArgument(new \GuzzleHttp\Client)
    ->addArgument(new \GuzzleHttp\Cookie\CookieJar);

unset($authentication);

$container->register('networkrail.client', \Trainjunkies\StaticDataFeeds\NetworkRail\Client::class)
    ->addArgument(new Reference('http.adapter.guzzle'));

$container->register(
    'networkrail.schedule.download_handler',
    \Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\DownloadHandler::class
);

/*
 * Commands
 */

// Full
$container->register('console.command.full.all', \Trainjunkies\StaticDataFeeds\Console\Command\Full\All::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.full.toc', \Trainjunkies\StaticDataFeeds\Console\Command\Full\Toc::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.full.freight', \Trainjunkies\StaticDataFeeds\Console\Command\Full\Freight::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

// Updates
$container->register('console.command.update.all', \Trainjunkies\StaticDataFeeds\Console\Command\Update\All::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.update.toc', \Trainjunkies\StaticDataFeeds\Console\Command\Update\Toc::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.update.freight', \Trainjunkies\StaticDataFeeds\Console\Command\Update\Freight::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

// Reference
$container->register(
    'console.command.reference.tocs',
    \Trainjunkies\StaticDataFeeds\Console\Command\Reference\TrainOperatingCompanies::class
)->addArgument(new \Trainjunkies\StaticDataFeeds\NetworkRail\Reference\Tocs);

// @codingStandardsIgnoreEnd
