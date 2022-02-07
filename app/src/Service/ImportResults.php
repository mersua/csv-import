<?php

namespace App\Service;

class ImportResults {
    private int $processed = 0;
    private int $successful = 0;
    private int $skipped = 0;

    public function getProcessed(): int
    {
        return $this->processed;
    }

    public function setProcessed(int $processed): self
    {
        $this->processed = $processed;

        return $this;
    }

    public function getSuccessful(): int
    {
        return $this->successful;
    }

    public function setSuccessful(int $successful): self
    {
        $this->successful = $successful;

        return $this;
    }

    public function getSkipped(): int
    {
        return $this->skipped;
    }

    public function setSkipped(int $skipped): self
    {
        $this->skipped = $skipped;

        return $this;
    }

    public static function log(int $processed, int $successful, int $skipped): self
    {
        return (new self())
            ->setProcessed($processed)
            ->setSuccessful($successful)
            ->setSkipped($skipped);
    }
}