<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Update;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\DownloaderCommandAbstract;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Schedule\Day;

class All extends DownloaderCommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('update:all')
            ->addArgument('day', InputArgument::REQUIRED, 'Day to download correct schedule for')
            ->setDescription('Download schedule update');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $day = (string)Day::fromDayString($input->getArgument('day'));
            $response = $this->client->request('CIF_ALL_UPDATE_DAILY', $day);

            $this->streamResponseToOutput($response, $output);

            return 0;
        } catch (\Exception $e) {
            $this->writeToErrorOutput($e->getMessage(), $output);

            return 1;
        }
    }
}
