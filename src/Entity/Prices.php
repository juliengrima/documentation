<?php

namespace App\Entity;

use App\Repository\PricesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PricesRepository::class)
 */
class Prices
{
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->id . $this->priceContent;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $priceName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $priceContent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceName(): ?string
    {
        return $this->priceName;
    }

    public function setPriceName(string $priceName): self
    {
        $this->priceName = $priceName;

        return $this;
    }

    public function getPriceContent(): ?string
    {
        return $this->priceContent;
    }

    public function setPriceContent(?string $priceContent): self
    {
        $this->priceContent = $priceContent;

        return $this;
    }
}
