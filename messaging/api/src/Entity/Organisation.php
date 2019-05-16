<?php

namespace App\Entity;

use App\Util\AppUtil;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrganisationRepository")
 * @ORM\Table(name="messaging__organisation")
 * @ORM\HasLifecycleCallbacks()
 */
class Organisation
{
    private $memberPage;
    private $memberCount;

    /**
     * @var int|null
     * @ORM\Id
     * @ORM\Column(type="integer",options={"unsigned":true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IndividualMember", mappedBy="organisation")
     */
    private $individualMembers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="organisation")
     */
    private $messages;

    public function __construct()
    {
        $this->individualMembers = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getIndividualMembersByPage($page = null, $limit = AppUtil::BATCH_SIZE)
    {
        if (empty($this->memberCount)) {
            $this->memberCount = $this->individualMembers->count();
        }

        if (empty($page)) {
            if ($this->memberPage === null) {
                $this->memberPage = 1;
            }
            $page = $this->memberPage;
            if ( ($this->memberPage - 1) * $limit > $this->memberCount) {
                return false;
            }
            $this->memberPage++;
        }

        $c = Criteria::create();
        $c->setFirstResult(($page - 1) * $limit);
        $c->setMaxResults($limit);
        return $this->individualMembers->matching($c);
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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
            $individualMember->setOrganisation($this);
        }

        return $this;
    }

    public function removeIndividualMember(IndividualMember $individualMember): self
    {
        if ($this->individualMembers->contains($individualMember)) {
            $this->individualMembers->removeElement($individualMember);
            // set the owning side to null (unless already changed)
            if ($individualMember->getOrganisation() === $this) {
                $individualMember->setOrganisation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setOrganisation($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getOrganisation() === $this) {
                $message->setOrganisation(null);
            }
        }

        return $this;
    }
}