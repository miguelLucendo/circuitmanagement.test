<?php

namespace App\Entity;

use App\Repository\TipoIncidenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TipoIncidenteRepository::class)]
class TipoIncidente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'tipo_incidente', targetEntity: Incidente::class)]
    private Collection $incidentes;

    public function __construct()
    {
        $this->incidentes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Incidente>
     */
    public function getIncidentes(): Collection
    {
        return $this->incidentes;
    }

    public function addIncidente(Incidente $incidente): self
    {
        if (!$this->incidentes->contains($incidente)) {
            $this->incidentes->add($incidente);
            $incidente->setTipoIncidente($this);
        }

        return $this;
    }

    public function removeIncidente(Incidente $incidente): self
    {
        if ($this->incidentes->removeElement($incidente)) {
            // set the owning side to null (unless already changed)
            if ($incidente->getTipoIncidente() === $this) {
                $incidente->setTipoIncidente(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}
