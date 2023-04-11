<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(length: 255)]
    private ?string $hora_inicio = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    private ?Coche $coche = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    private ?Usuario $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getHoraInicio(): ?string
    {
        return $this->hora_inicio;
    }

    public function setHoraInicio(string $hora_inicio): self
    {
        $this->hora_inicio = $hora_inicio;

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
