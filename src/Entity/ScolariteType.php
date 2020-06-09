<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScolariteTypeRepository")
 *
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class ScolariteType
{
    use SekolikoEtablissementTrait;
    use EntityIdTrait;

    /**
     * @ORM\Column(type="string", length=100)
     *
     * @Assert\NotBlank()
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Scolarite", mappedBy="type")
     */
    private $scolarites;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * ScolariteType constructor.
     */
    public function __construct()
    {
        $this->scolarites = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     *
     * @return ScolariteType
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Scolarite[]
     */
    public function getScolarites(): Collection
    {
        return $this->scolarites;
    }

    /**
     * @param Scolarite $scolarite
     *
     * @return ScolariteType
     */
    public function addScolarite(Scolarite $scolarite): self
    {
        if (!$this->scolarites->contains($scolarite)) {
            $this->scolarites[] = $scolarite;
            $scolarite->setType($this);
        }

        return $this;
    }

    /**
     * @param Scolarite $scolarite
     *
     * @return ScolariteType
     */
    public function removeScolarite(Scolarite $scolarite): self
    {
        if ($this->scolarites->contains($scolarite)) {
            $this->scolarites->removeElement($scolarite);
            // set the owning side to null (unless already changed)
            if ($scolarite->getType() === $this) {
                $scolarite->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param $deletedAt
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;
    }
}
