<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProductService {
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function saveProduct(Product $product): int
    {
        $errors = $this->validator->validate($product);

        if (count($errors) > 0) {
            $errorStrings = [];

            foreach ($errors as $error) {
                $errorStrings[] = $error->getMessage();
            }

            throw new \UnexpectedValueException(sprintf('While product saving next problems occurred: %s', implode('. ', $errorStrings)));
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product->getId();
    }
}