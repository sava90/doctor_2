<?php

namespace App\Document;

use App\Repository\DrugRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(repositoryClass=DrugRepository::class)
 */
class Drug
{
    /**
     * @ODM\Id(strategy="INCREMENT")
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $name;

    /**
     * @ODM\ReferenceMany(targetDocument=Disease::class)
     */
    private $diseases;

    public function __construct() {
        $this->diseases = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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

    public function addDisease(Disease $disease): self
    {
        $this->diseases->add($disease);

        return $this;
    }

    public function removeDisease(Disease $disease): self
    {
        if ($this->diseases->contains($disease)) {
            $this->diseases->removeElement($disease);
        }

        return $this;
    }
}
