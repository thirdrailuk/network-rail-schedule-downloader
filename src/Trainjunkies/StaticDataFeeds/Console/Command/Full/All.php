<?php

namespace Trainjunkies\StaticDataFeeds\Console\Command\Full;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Trainjunkies\StaticDataFeeds\Console\Command\DownloaderCommandAbstract;

class All extends DownloaderCommandAbstract
{
    protected function configure()
    {
        $this
            ->setName('full:all')
            ->setDescription('Download full extract schedule database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $response = $this->client->request('CIF_ALL_FULL_DAILY', 'toc-full');

            $this->streamResponseToOutput($response, $output);

            return 0;
        } catch (\Exception $e) {
            $this->writeToErrorOutput($e->getMessage(), $output);

            return 1;
        }
    }
}
