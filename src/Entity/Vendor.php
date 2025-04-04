<?php

namespace App\Entity;

use App\Repository\VendorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VendorRepository::class)]
class Vendor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Smartphone>
     */
    #[ORM\OneToMany(targetEntity: Smartphone::class, mappedBy: 'vendor')]
    private Collection $smartphones;

    public function __construct()
    {
        $this->smartphones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Smartphone>
     */
    public function getSmartphones(): Collection
    {
        return $this->smartphones;
    }

    public function addSmartphone(Smartphone $smartphone): static
    {
        if (!$this->smartphones->contains($smartphone)) {
            $this->smartphones->add($smartphone);
            $smartphone->setVendor($this);
        }

        return $this;
    }

    public function removeSmartphone(Smartphone $smartphone): static
    {
        if ($this->smartphones->removeElement($smartphone)) {
            // set the owning side to null (unless already changed)
            if ($smartphone->getVendor() === $this) {
                $smartphone->setVendor(null);
            }
        }

        return $this;
    }
}
