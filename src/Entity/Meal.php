<?php

namespace App\Entity;

use App\Repository\MealRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MealRepository::class)]
class Meal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['meal:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['meal:read'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['meal:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['meal:read'])]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'meal')]
    private ?CategoryMeal $categoryMeal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategoryMeal(): ?CategoryMeal
    {
        return $this->categoryMeal;
    }

    #[Groups(['meal:read'])]
    #[SerializedName('mealName')]
    public function getCategoryMealName(): string
    {
        return $this->getCategoryMeal()->getName();
    }

    public function setCategoryMeal(?CategoryMeal $categoryMeal): self
    {
        $this->categoryMeal = $categoryMeal;

        return $this;
    }
}
