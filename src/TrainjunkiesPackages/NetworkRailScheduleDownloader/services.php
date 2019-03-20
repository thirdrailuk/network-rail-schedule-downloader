<?php

use Symfony\Component\DependencyInjection\Reference;

// @codingStandardsIgnoreStart

try {
    $authentication = \TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Authentication::fromUsernameAndPassword(
        getenv('TRAINJUNKIES_NETWORKRAIL_USERNAME'),
        getenv('TRAINJUNKIES_NETWORKRAIL_PASSWORD')
    );
}
catch (Exception $e) {
    fwrite(STDERR, $e->getMessage() . PHP_EOL);
    exit(1);
}

// Services
$container->register('http.adapter.guzzle', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Http\GuzzleAdapter::class)
    ->addArgument($authentication)
    ->addArgument(new \GuzzleHttp\Client)
    ->addArgument(new \GuzzleHttp\Cookie\CookieJar);

unset($authentication);

$container->register('networkrail.client', \TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Client::class)
    ->addArgument(new Reference('http.adapter.guzzle'));

$container->register(
    'networkrail.schedule.download_handler',
    \TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Schedule\DownloadHandler::class
);

/*
 * Commands
 */

// Full
$container->register('console.command.full.all', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Full\All::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.full.toc', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Full\Toc::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.full.freight', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Full\Freight::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

// Updates
$container->register('console.command.update.all', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Update\All::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.update.toc', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Update\Toc::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

$container->register('console.command.update.freight', \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Update\Freight::class)
    ->addArgument(new Reference('networkrail.client'))
    ->addArgument(new Reference('networkrail.schedule.download_handler'));

// Reference
$container->register(
    'console.command.reference.tocs',
    \TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Reference\TrainOperatingCompanies::class
)->addArgument(new \TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Reference\Tocs);

// @codingStandardsIgnoreEnd
