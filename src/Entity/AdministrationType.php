<?php
/**
 * Julien Rajerison <julienrajerison5@gmail.com>.
 **/

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdministrationTypeRepository")
 */
class AdministrationType
{
    use SekolikoEtablissementTrait;

    use EntityIdTrait;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Administrator", mappedBy="type")
     */
    private $administrators;

    /**
     * AdministrationType constructor.
     */
    public function __construct()
    {
        $this->administrators = new ArrayCollection();
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
     * @return AdministrationType
     */
    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Administrator[]
     */
    public function getAdministrators(): Collection
    {
        return $this->administrators;
    }

    /**
     * @param Administrator $administrator
     *
     * @return AdministrationType
     */
    public function addAdministrator(Administrator $administrator): self
    {
        if (!$this->administrators->contains($administrator)) {
            $this->administrators[] = $administrator;
            $administrator->setType($this);
        }

        return $this;
    }

    /**
     * @param Administrator $administrator
     *
     * @return AdministrationType
     */
    public function removeAdministrator(Administrator $administrator): self
    {
        if ($this->administrators->contains($administrator)) {
            $this->administrators->removeElement($administrator);
            // set the owning side to null (unless already changed)
            if ($administrator->getType() === $this) {
                $administrator->setType(null);
            }
        }

        return $this;
    }
}
