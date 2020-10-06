<?php

namespace App\Document;

use App\Repository\PrescriptionLogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(repositoryClass=PrescriptionLogRepository::class)
 */
class PrescriptionLog
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @ODM\Field(type="date"))
     */
    private $date;

    /**
     * @ODM\ReferenceOne(targetDocument="Disease")
     */
    private $disease;

    public function __construct() {
        $this->disease = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDisease(): ?Disease
    {
        return $this->disease;
    }

    public function setDisease(Disease $disease): self
    {
        $this->disease = $disease;

        return $this;
    }
}
