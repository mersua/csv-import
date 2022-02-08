<?php

declare(strict_types=1);

namespace App\Service;

interface ImporterInterface {
    public function import(string $source, bool $testMode = false): ImportResults;
}