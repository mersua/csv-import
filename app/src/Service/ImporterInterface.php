<?php

namespace App\Service;

interface ImporterInterface {
    public function import(string $source, bool $testMode = false): ImportResults;
}