<?php

namespace TrainjunkiesPackages\StaticDataFeeds\Console\Command\Update;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TrainjunkiesPackages\StaticDataFeeds\Console\Command\DownloaderCommandAbstract;
use TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Schedule\Day;
use TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Schedule\TOC as TOCCode;

class Toc extends DownloaderCommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('update:toc')
            ->addArgument('toc', InputArgument::REQUIRED, 'Train Operating Company to download')
            ->addArgument('day', InputArgument::REQUIRED, 'Day to download correct schedule for')
            ->setDescription('Download daily schedule update for TOC');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $toc = TOCCode::fromCode($input->getArgument('toc'))->update();
            $day = (string)Day::fromDayString($input->getArgument('day'));

            $response = $this->client->request($toc, $day);

            $this->streamResponseToOutput($response, $output);

            return 0;
        } catch (\Exception $e) {
            $this->writeToErrorOutput($e->getMessage(), $output);

            return 1;
        }
    }
}
