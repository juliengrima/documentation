<?php

namespace App\Entity;

use App\Repository\CustomersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomersRepository::class)
 */
class Customers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone2;

//    /**
//     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "merge", "remove"})
//     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
//     */
//    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhone1(): ?int
    {
        return $this->phone1;
    }

    public function setPhone1(?int $phone1): self
    {
        $this->phone1 = $phone1;

        return $this;
    }

    public function getPhone2(): ?int
    {
        return $this->phone2;
    }

    public function setPhone2(?int $phone2): self
    {
        $this->phone2 = $phone2;

        return $this;
    }

    public function getPhone3(): ?int
    {
        return $this->phone3;
    }

    public function setPhone3(?int $phone3): self
    {
        $this->phone3 = $phone3;

        return $this;
    }
}
