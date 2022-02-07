<?php

namespace App\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CSVImporter implements ImporterInterface
{
    public function import(string $source, bool $testMode = false): ImportResults
    {
        $path = __DIR__ . '/../../var/data/' . $source;

        if (!file_exists($path)) {
            throw new FileNotFoundException('CSV file does not exist');
        }

        $handle = fopen($path, "r");
        if (!$handle) {
            throw new FileException('CSV file can not be read');
        }

        while ($data = fgetcsv($handle)) {

        }

        fclose($handle);

        return ImportResults::log(0, 0, 0);
    }
}