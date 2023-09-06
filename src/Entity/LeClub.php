<?php

namespace App\Entity;

use App\Repository\LeClubRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeClubRepository::class)]
class LeClub
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $histoire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHistoire(): ?string
    {
        return $this->histoire;
    }

    public function setHistoire(string $histoire): static
    {
        $this->histoire = $histoire;

        return $this;
    }
}
