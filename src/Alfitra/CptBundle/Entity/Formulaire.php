<?php

namespace Alfitra\CptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Formulaire
 *
 * @ORM\Table(name="formulaire")
 * @ORM\Entity(repositoryClass="Alfitra\CptBundle\Repository\FormulaireRepository")
 */
class Formulaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="civilite", type="string", length=255)
     */
    private $civilite;

    /**
     * @var int
     *
     * @ORM\Column(name="montant", type="integer")
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     * 
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="modePaiement", type="string", length=255)
     */
    private $modePaiement;

    /**
     * @var bool
     *
     * @ORM\Column(name="anonyme", type="boolean")
     */
    private $anonyme;

    /**
     * @var bool
     *
     * @ORM\Column(name="recuFiscal", type="boolean")
     */
    private $recuFiscal;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="invocationPourqui", type="string", length=255, nullable=true)
     */
    private $invocationPourqui ;

    /**
     * @var string
     *
     * @ORM\Column(name="invocationPourquoi", type="string", length=255, nullable=true)
     */
    private $invocationPourquoi;

    /**
     * @var string
     *
     * @ORM\Column(name="invocationDetails", type="string", length=255, nullable=true)
     */
    private $invocationDetails;

    /**
     * @var bool
     *
     * @ORM\Column(name="announced", type="boolean")
     */
    private $announced;


    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    /**
     * @var string
     * 
     * @ORM\Column(name="postedby", type="string")
     */
    protected $postedBy;


    public function __construct(){
        $this->date = new \Datetime();
        $this->announced = 0;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set civilite
     *
     * @param string $civilite
     *
     * @return Formulaire
     */
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

        return $this;
    }

    /**
     * Get civilite
     *
     * @return string
     */
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set montant
     *
     * @param integer $montant
     *
     * @return Formulaire
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return int
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Formulaire
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Formulaire
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set modePaiement
     *
     * @param string $modePaiement
     *
     * @return Formulaire
     */
    public function setModePaiement($modePaiement)
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    /**
     * Get modePaiement
     *
     * @return string
     */
    public function getModePaiement()
    {
        return $this->modePaiement;
    }

    /**
     * Set anonyme
     *
     * @param boolean $anonyme
     *
     * @return Formulaire
     */
    public function setAnonyme($anonyme)
    {
        $this->anonyme = $anonyme;

        return $this;
    }

    /**
     * Get anonyme
     *
     * @return bool
     */
    public function getAnonyme()
    {
        return $this->anonyme;
    }

    /**
     * Set recuFiscal
     *
     * @param boolean $recuFiscal
     *
     * @return Formulaire
     */
    public function setRecuFiscal($recuFiscal)
    {
        $this->recuFiscal = $recuFiscal;

        return $this;
    }

    /**
     * Get recuFiscal
     *
     * @return bool
     */
    public function getRecuFiscal()
    {
        return $this->recuFiscal;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Formulaire
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set invocationPourqui
     *
     * @param string $invocationPourqui
     *
     * @return Formulaire
     */
    public function setInvocationPourqui($invocationPourqui)
    {
        $this->invocationPourqui = $invocationPourqui;

        return $this;
    }

    /**
     * Get invocationPourqui
     *
     * @return string
     */
    public function getInvocationPourqui()
    {
        return $this->invocationPourqui;
    }

    /**
     * Set invocationPourquoi
     *
     * @param string $invocationPourquoi
     *
     * @return Formulaire
     */
    public function setInvocationPourquoi($invocationPourquoi)
    {
        $this->invocationPourquoi = $invocationPourquoi;

        return $this;
    }

    /**
     * Get invocationPourquoi
     *
     * @return string
     */
    public function getInvocationPourquoi()
    {
        return $this->invocationPourquoi;
    }

    /**
     * Set invocationDetails
     *
     * @param string $invocationDetails
     *
     * @return Formulaire
     */
    public function setInvocationDetails($invocationDetails)
    {
        $this->invocationDetails = $invocationDetails;

        return $this;
    }

    /**
     * Get invocationDetails
     *
     * @return string
     */
    public function getInvocationDetails()
    {
        return $this->invocationDetails;
    }

    /**
     * Set announced
     *
     * @param boolean $announced
     *
     * @return Formulaire
     */
    public function setAnnounced($announced)
    {
        $this->announced = $announced;

        return $this;
    }

    /**
     * Get announced
     *
     * @return bool
     */
    public function getAnnounced()
    {
        return $this->announced;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Formulaire
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set postedBy
     *
     * @param string $postedBy
     *
     * @return Formulaire
     */
    public function setPostedBy($postedBy)
    {
        $this->postedBy = $postedBy;

        return $this;
    }

    /**
     * Get postedBy
     *
     * @return string
     */
    public function getPostedBy()
    {
        return $this->postedBy;
    }
}
