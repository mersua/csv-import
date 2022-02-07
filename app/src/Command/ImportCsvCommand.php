<?php

namespace App\Command;

use App\Service\CSVImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportCsvCommand extends Command
{
    protected CSVImporter $csvImporter;

    protected static $defaultName = 'app:import-csv';

    public function __construct(CSVImporter $csvImporter) {
        $this->csvImporter = $csvImporter;
    }

    protected function configure()
    {
        $this
            ->setDescription('Import CSV file with products')
            ->addArgument('csvFile', InputArgument::REQUIRED, 'Path to CSV file')
            ->addOption('test', null, InputOption::VALUE_NONE, 'Run in test mode (without adding data into database)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $csvFile = $input->getArgument('csvFile');
        $testMode = $input->getOption('test');

        try {
            $result = $this->csvImporter->import($csvFile, $testMode);

            $io->note(sprintf('Count of product items that was processed: %s', $result->getProcessed()));
            $io->success(sprintf('Count of product items that was successfully imported: %s', $result->getSuccessful()));
            $io->note(sprintf('Count of product items that was skipped: %s', $result->getSkipped()));
        } catch (\Exception $exception) {
            $io->error(sprintf('During import exception appear: %s', $exception->getMessage()));

            return $exception->getCode();
        }

        return 0;
    }
}
