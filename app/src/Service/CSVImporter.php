<?php

namespace App\Service;

class CSVImporter implements ImporterInterface
{
    public function import(string $source, bool $testMode = false): ImportResults
    {

        return ImportResults::log(0, 0, 0);
    }
}