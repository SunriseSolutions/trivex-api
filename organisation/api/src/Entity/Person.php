<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 * @ORM\Table(name="organisation__person")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $uuid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IndividualMember", mappedBy="person")
     */
    private $individualMembers;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jobTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $employerName;

    public function __construct()
    {
        $this->individualMembers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * @return Collection|IndividualMember[]
     */
    public function getIndividualMembers(): Collection
    {
        return $this->individualMembers;
    }

    public function addIndividualMember(IndividualMember $individualMember): self
    {
        if (!$this->individualMembers->contains($individualMember)) {
            $this->individualMembers[] = $individualMember;
            $individualMember->setPerson($this);
        }

        return $this;
    }

    public function removeIndividualMember(IndividualMember $individualMember): self
    {
        if ($this->individualMembers->contains($individualMember)) {
            $this->individualMembers->removeElement($individualMember);
            // set the owning side to null (unless already changed)
            if ($individualMember->getPerson() === $this) {
                $individualMember->setPerson(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getJobTitle(): ?string
    {
        return $this->jobTitle;
    }

    public function setJobTitle(?string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    public function getEmployerName(): ?string
    {
        return $this->employerName;
    }

    public function setEmployerName(?string $employerName): self
    {
        $this->employerName = $employerName;

        return $this;
    }
}
