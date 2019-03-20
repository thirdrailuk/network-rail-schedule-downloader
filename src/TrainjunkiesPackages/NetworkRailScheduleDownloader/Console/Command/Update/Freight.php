<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Update;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\DownloaderCommandAbstract;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Schedule\Day;

class Freight extends DownloaderCommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('update:freight')
            ->addArgument('day', InputArgument::REQUIRED, 'Day to download correct schedule for')
            ->setDescription('Download daily schedule update for Freight');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $day = (string)Day::fromDayString($input->getArgument('day'));

            $response = $this->client->request('CIF_FREIGHT_UPDATE_DAILY', $day);

            $this->streamResponseToOutput($response, $output);

            return 0;
        } catch (\Exception $e) {
            $this->writeToErrorOutput($e->getMessage(), $output);

            return 1;
        }
    }
}
