<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     attributes={"access_control"="is_granted('ROLE_USER')"},
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OptionSetRepository")
 * @ORM\Table(name="messaging__option_set")
 * @ORM\HasLifecycleCallbacks()
 */
class OptionSet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     * @Groups("read")
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read","write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MessageOption", mappedBy="optionSet")
     */
    private $messageOptions;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Organisation", inversedBy="optionSets")
     * @ORM\JoinColumn(name="id_organisation", referencedColumnName="id")
     * @Groups({"read","write"})
     */
    private $organisation;

    private $organisationUuid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="optionSet")
     */
    private $messages;

    public function __construct()
    {
        $this->messageOptions = new ArrayCollection();
        $this->messages = new ArrayCollection();
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
     * @return Collection|MessageOption[]
     */
    public function getMessageOptions(): Collection
    {
        return $this->messageOptions;
    }

    public function addMessageOption(MessageOption $messageOption): self
    {
        if (!$this->messageOptions->contains($messageOption)) {
            $this->messageOptions[] = $messageOption;
            $messageOption->setOptionSet($this);
        }

        return $this;
    }

    public function removeMessageOption(MessageOption $messageOption): self
    {
        if ($this->messageOptions->contains($messageOption)) {
            $this->messageOptions->removeElement($messageOption);
            // set the owning side to null (unless already changed)
            if ($messageOption->getOptionSet() === $this) {
                $messageOption->setOptionSet(null);
            }
        }

        return $this;
    }

    public function getOrganisation(): ?Organisation
    {
        return $this->organisation;
    }

    public function setOrganisation(?Organisation $organisation): self
    {
        $this->organisation = $organisation;

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
            $message->setOptionSet($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->contains($message)) {
            $this->messages->removeElement($message);
            // set the owning side to null (unless already changed)
            if ($message->getOptionSet() === $this) {
                $message->setOptionSet(null);
            }
        }

        return $this;
    }
}
