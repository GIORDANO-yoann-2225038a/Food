<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 35)]
    private ?string $email = null;

    #[ORM\Column(length: 35)]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $test = null;

    #[ORM\Column(length: 255)]
    private ?string $test1 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(string $test): static
    {
        $this->test = $test;

        return $this;
    }

    public function getTest1(): ?string
    {
        return $this->test1;
    }

    public function setTest1(string $test1): static
    {
        $this->test1 = $test1;

        return $this;
    }
}
