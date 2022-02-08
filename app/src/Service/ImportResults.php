<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;

class ImportResults {
    private int $processed = 0;
    private int $successful = 0;
    private int $skipped = 0;
    private array $failedProducts = [];

    public function getProcessed(): int
    {
        return $this->processed;
    }

    public function setProcessed(int $processed): self
    {
        $this->processed = $processed;

        return $this;
    }

    public function addProcessed(): self
    {
        $this->processed++;

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

    public function addSuccessful(): self
    {
        $this->successful++;

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

    public function addSkipped(): self
    {
        $this->skipped++;

        return $this;
    }

    public function getFailedProducts(): array
    {
        return $this->failedProducts;
    }

    public function addFailedProduct(Product $failedProduct): self
    {
        $this->failedProducts[] = json_encode($failedProduct);

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