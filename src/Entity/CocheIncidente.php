<?php

namespace App\Entity;

use App\Repository\CocheIncidenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CocheIncidenteRepository::class)]
class CocheIncidente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne]
    private ?Incidente $incidente = null;

    #[ORM\ManyToOne]
    private ?Coche $coche = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getIncidente(): ?Incidente
    {
        return $this->incidente;
    }

    public function setIncidente(?Incidente $incidente): self
    {
        $this->incidente = $incidente;

        return $this;
    }

    public function getCoche(): ?Coche
    {
        return $this->coche;
    }

    public function setCoche(?Coche $coche): self
    {
        $this->coche = $coche;

        return $this;
    }
}
