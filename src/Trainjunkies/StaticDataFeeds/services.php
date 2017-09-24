<?php

use Symfony\Component\DependencyInjection\Reference;

// @codingStandardsIgnoreStart

// Services
$authentication = \Trainjunkies\StaticDataFeeds\NetworkRail\Authentication::fromUsernameAndPassword(
    getenv('TRAINJUNKIES_NETWORKRAIL_USERNAME'),
    getenv('TRAINJUNKIES_NETWORKRAIL_PASSWORD')
);

$container->register('networkrail.client', \Trainjunkies\StaticDataFeeds\NetworkRail\Client::class)
    ->addArgument(new \GuzzleHttp\Client)
    ->addArgument(new \Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\UriFactory)
    ->addArgument([
        'cookie' => new \GuzzleHttp\Cookie\CookieJar,
        'stream' => true,
        'auth' => [
            $authentication->username(),
            $authentication->password(),
            'basic'
        ]
    ]);
unset($authentication);

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
