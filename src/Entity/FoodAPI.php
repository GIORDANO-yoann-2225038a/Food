<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FoodAPIRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodAPIRepository::class)]
#[ApiResource]
class FoodAPI
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ApiFood = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApiFood(): ?string
    {
        return $this->ApiFood;
    }

    public function setApiFood(string $ApiFood): static
    {
        $this->ApiFood = $ApiFood;

        return $this;
    }
}
