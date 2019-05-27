<?php


namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateDeNaissance;

    /**
     * @var
     * @ORM\Column(type="string",length=100,nullable=false)
     */
    private $nom;

    /**
     * @var
     * @ORM\Column(type="string",length=100,nullable=true)
     */
    private $prenom;

    /**
     * @var
     * @ORM\Column(type="string",length=10,nullable=false)
     */
    private $sexe;

    /**
     * @var
     * @ORM\Column(type="string",length=100,nullable=true)
     */
    private $contact;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Professeur", mappedBy="profs", cascade={"persist", "remove"})
     */
    private $professeur;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getDateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * @param mixed $dateDeNaissance
     */
    public function setDateDeNaissance($dateDeNaissance): void
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * @param mixed $sexe
     */
    public function setSexe($sexe): void
    {
        $this->sexe = $sexe;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(Professeur $professeur): self
    {
        $this->professeur = $professeur;

        // set the owning side of the relation if necessary
        if ($this !== $professeur->getProfs()) {
            $professeur->setProfs($this);
        }

        return $this;
    }
}