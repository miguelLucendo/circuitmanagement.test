<?php

namespace App\Entity;

use App\Repository\IncidenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenteRepository::class)]
class Incidente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'incidentes')]
    private ?TipoIncidente $tipo_incidente = null;

    #[ORM\ManyToOne(inversedBy: 'incidentes')]
    private ?Usuario $usuario = null;

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

    public function getTipoIncidente(): ?TipoIncidente
    {
        return $this->tipo_incidente;
    }

    public function setTipoIncidente(?TipoIncidente $tipo_incidente): self
    {
        $this->tipo_incidente = $tipo_incidente;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
