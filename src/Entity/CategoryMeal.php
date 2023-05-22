<?php

namespace App\Entity;

use App\Repository\CategoryMealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryMealRepository::class)]
class CategoryMeal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['categorymeal:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['categorymeal:read'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categoryMeal', targetEntity: Meal::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $meal;

    public function __construct()
    {
        $this->meal = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Meal>
     */
    public function getMeal(): Collection
    {
        return $this->meal;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meal->contains($meal)) {
            $this->meal->add($meal);
            $meal->setCategoryMeal($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meal->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getCategoryMeal() === $this) {
                $meal->setCategoryMeal(null);
            }
        }

        return $this;
    }
}
