<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class CSVImporter implements ImporterInterface
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function import(string $source, bool $testMode = false): ImportResults
    {
        $result = ImportResults::log(0, 0, 0);
        $path = __DIR__ . '/../../var/data/' . $source;

        if (!file_exists($path)) {
            throw new FileNotFoundException('CSV file does not exist');
        }

        $handle = fopen($path, "r");
        if (!$handle) {
            throw new FileException('CSV file can not be read');
        }

        fgetcsv($handle); // skip first line of file
        while ($data = fgetcsv($handle)) {
            $result->addProcessed();

            $code = trim($data[0]);
            $name = trim($data[1]);
            $description = trim($data[2]);
            $stock = (int) trim($data[3]);
            $price = (float) trim(str_replace(['$'], '', $data[4]));
            $discontinuedAt = trim($data[5]) === 'yes' ? new \DateTime() : null;
            $addedAt = new \DateTime();

            $product = (new Product())
                ->setName($name)
                ->setDescription($description)
                ->setCode($code)
                ->setStock($stock)
                ->setPrice($price)
                ->setAddedAt($addedAt)
                ->setDiscontinuedAt($discontinuedAt);

            if (!$product->isValid()) {
                $result->addSkipped();
                $result->addFailedProduct($product);

                continue;
            }

            if (!$testMode) {
                if ($this->productService->saveProduct($product)) {
                    $result->addSuccessful();
                }
            }
        }

        fclose($handle);

        return $result;
    }
}