<?php

namespace App\Entity;

use App\Repository\IncidenteRepository;
use App\Entity\CocheIncidente;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'incidente', targetEntity: CocheIncidente::class)]
    private Collection $coche_incidentes;

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
    public function getCocheIncidentes(): Collection
    {
        return $this->coche_incidentes;
    }

    public function addCocheIncidentes(CocheIncidente $coche_incidente): self
    {
        if (!$this->coche_incidentes->contains($coche_incidente)) {
            $this->coche_incidentes->add($coche_incidente);
            $coche_incidente->setIncidente($this);
        }

        return $this;
    }

    public function removeCocheIncidentes(CocheIncidente $coche_incidente): self
    {
        if ($this->coche_incidentes->removeElement($coche_incidente)) {
            // set the owning side to null (unless already changed)
            if ($coche_incidente->getIncidente() === $this) {
                $coche_incidente->setIncidente(null);
            }
        }

        return $this;
    }
}
