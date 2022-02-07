<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="tblProductData")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(name="intProductDataId", type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="strProductName", type="string", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Product's name must be at least {{ limit }} characters long",
     *      maxMessage = "Product's name cannot be longer than {{ limit }} characters"
     * )
     */
    private string $name;

    /**
     * @ORM\Column(name="strProductDesc", type="string", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Product's description must be at least {{ limit }} characters long",
     *      maxMessage = "Product's description cannot be longer than {{ limit }} characters"
     * )
     */
    private string $description;

    /**
     * @ORM\Column(name="strProductCode", type="string", nullable=false)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 10,
     *      minMessage = "Product's code must be at least {{ limit }} characters long",
     *      maxMessage = "Product's code cannot be longer than {{ limit }} characters"
     * )
     */
    private string $code;

    /**
     * @ORM\Column(name="intStock", type="integer", nullable=false)
     * @Assert\PositiveOrZero
     */
    private int $stock;

    /**
     * @ORM\Column(name="decPrice", type="decimal", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank
     * @Assert\Type(type="Numeric")
     */
    private float $price;

    /**
     * @ORM\Column(name="dtmAdded", type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private ?\DateTime $addedAt;

    /**
     * @ORM\Column(name="dtmDiscontinued", type="datetime", nullable=true)
     * @Assert\DateTime
     */
    private ?\DateTime $discontinuedAt;

    /**
     * @ORM\Column(name="stmTimestamp", type="datetime", nullable=false)
     * @Assert\NotBlank
     * @Assert\DateTime
     */
    private \DateTime $updatedAt;

    public function __construct()
    {
        $this->addedAt = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAddedAt(): ?\DateTime
    {
        return $this->addedAt;
    }

    public function setAddedAt(?\DateTime $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    public function getDiscontinuedAt(): ?\DateTime
    {
        return $this->discontinuedAt;
    }

    public function setDiscontinuedAt(?\DateTime $discontinuedAt): self
    {
        $this->discontinuedAt = $discontinuedAt;

        return $this;
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
