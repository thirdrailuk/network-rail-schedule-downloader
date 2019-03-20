<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Full;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\DownloaderCommandAbstract;

class Freight extends DownloaderCommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('full:freight')
            ->setDescription('Download freight extract schedule database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $response = $this->client->request('CIF_FREIGHT_FULL_DAILY', 'toc-full');

            $this->streamResponseToOutput($response, $output);

            return 0;
        } catch (\Exception $e) {
            $this->writeToErrorOutput($e->getMessage(), $output);

            return 1;
        }
    }
}
