<?php

namespace Trainjunkies\StaticDataFeeds\Console\Command\Update;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Trainjunkies\StaticDataFeeds\Console\Command\DownloaderCommandAbstract;
use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\Day;
use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\TOC as TOCCode;

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
