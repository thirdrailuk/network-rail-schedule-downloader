<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Console\Command\Reference;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Reference\Tocs;

class TrainOperatingCompanies extends Command
{
    /**
     * @var Tocs
     */
    private $tocsList;

    public function __construct(Tocs $tocsList)
    {
        parent::__construct();
        $this->tocsList = $tocsList;
    }

    protected function configure()
    {
        $this
            ->setName('reference:tocs')
            ->setDescription('List of TOCs & business codes for schedule');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);
        $table->setHeaders(
            [
            'Company Name',
            'Business Code',
            'Sector Code',
            'ATOC Code'
            ]
        );
        $table->addRows($this->tocsList->toArray());
        $table->render();
    }
}
