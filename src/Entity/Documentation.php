<?php

namespace App\Entity;

use App\Repository\DocumentationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentationRepository::class)
 */
class Documentation
{
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->id;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $document;

    /**
     * @ORM\OneToOne(targetEntity=Customers::class, inversedBy="documentation", cascade={"persist", "remove"})
     */
    private $customers_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): self
    {
        $this->document = $document;

        return $this;
    }

    public function getCustomersId(): ?Customers
    {
        return $this->customers_id;
    }

    public function setCustomersId(?Customers $customers_id): self
    {
        $this->customers_id = $customers_id;

        return $this;
    }
}
