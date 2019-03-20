<?php

namespace TrainjunkiesPackages\StaticDataFeeds\Console\Command;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Client;
use TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Schedule\DownloadHandler;

abstract class DownloaderCommandAbstract extends Command
{
    /**
     * @var Client
     */
    protected $client;
    /**
     * @var DownloadHandler
     */
    protected $downloadHandler;

    public function __construct(Client $client, DownloadHandler $downloadHandler)
    {
        $this->client = $client;
        $this->downloadHandler = $downloadHandler;

        parent::__construct();
    }

    public function streamResponseToOutput(ResponseInterface $response, OutputInterface $output)
    {
        $this->downloadHandler->handleDownload(
            $response,
            function ($chunk) use ($output) {
                $output->write($chunk, false, OutputInterface::OUTPUT_RAW);
            }
        );
    }

    public function writeToErrorOutput($message, ConsoleOutputInterface $output)
    {
        $output->getErrorOutput()->writeln(
            sprintf('<error>%s</error>', $message)
        );
    }
}
