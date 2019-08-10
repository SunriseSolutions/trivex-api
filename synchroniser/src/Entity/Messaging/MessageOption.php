<?php

namespace App\Entity\Messaging;

//use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use App\Util\Messaging\AppUtil;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * ApiResource(
 *     attributes={"access_control"="is_granted('ROLE_USER')"},
 *     normalizationContext={"groups"={"read_option"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Messaging\MessageOptionRepository")
 * @ORM\Table(name="messaging__option")
 * @ORM\HasLifecycleCallbacks()
 */
class MessageOption
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=191)
     * @Groups("read_option")
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read_option","write"})
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Messaging\OptionSet", inversedBy="messageOptions", cascade={"persist"})
     * @ORM\JoinColumn(name="id_option_set", referencedColumnName="id", onDelete="CASCADE")
     * @Groups({"read_option","write"})
     */
    private $optionSet;

    /**
     * @ORM\PrePersist
     */
    public function initiateUuid()
    {
        if (empty($this->uuid)) {
            $this->uuid = AppUtil::generateUuid();
        }
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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOptionSet(): ?OptionSet
    {
        return $this->optionSet;
    }

    public function setOptionSet(?OptionSet $optionSet): self
    {
        $this->optionSet = $optionSet;

        return $this;
    }
}
