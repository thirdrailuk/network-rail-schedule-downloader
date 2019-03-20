<?php

namespace TrainjunkiesPackages\StaticDataFeeds\Console\Command\Full;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use TrainjunkiesPackages\StaticDataFeeds\Console\Command\DownloaderCommandAbstract;
use TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Schedule\TOC as TypeTOC;

class Toc extends DownloaderCommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('full:toc')
            ->addArgument('toc', InputArgument::REQUIRED, 'Train Operating Company to download')
            ->setDescription('Download extract schedule database for TOC');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $type = TypeTOC::fromCode($input->getArgument('toc'))->full();
            $response = $this->client->request($type, 'toc-full');

            $this->streamResponseToOutput($response, $output);

            return 0;
        } catch (\Exception $e) {
            $this->writeToErrorOutput($e->getMessage(), $output);

            return 1;
        }
    }
}
