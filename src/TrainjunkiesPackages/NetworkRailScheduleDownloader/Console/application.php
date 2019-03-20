<?php

use Symfony\Component\Console\Application;

$application = new Application('Trainjunkies - Network Rail Schedule Downloader');

$application->add($container->get('console.command.full.all'));
$application->add($container->get('console.command.full.toc'));
$application->add($container->get('console.command.full.freight'));

$application->add($container->get('console.command.update.all'));
$application->add($container->get('console.command.update.toc'));
$application->add($container->get('console.command.update.freight'));

$application->add($container->get('console.command.reference.tocs'));

$application->run();
