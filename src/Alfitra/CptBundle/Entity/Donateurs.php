<?php

namespace Alfitra\CptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donateurs
 *
 * @ORM\Table(name="donateurs")
 * @ORM\Entity(repositoryClass="Alfitra\CptBundle\Repository\DonateursRepository")
 */
class Donateurs
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
     * @var int
     *
     * @ORM\Column(name="montant", type="integer")
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="moyenDePaiement", type="string", length=255)
     */
    private $moyenDePaiement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
    * @ORM\ManyToOne(targetEntity="Alfitra\CptBundle\Entity\Evenement")
    * @ORM\JoinColumn(nullable=false)
    */
    private $evenement;

    /**
    * @ORM\ManyToOne(targetEntity="Alfitra\CptBundle\Entity\Collecteur")
    * @ORM\JoinColumn(nullable=false)
    */
    private $collecteur;


    public function __construct(){
        $this->date = new \DateTime();
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
     * Set montant
     *
     * @param integer $montant
     *
     * @return Donateurs
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
     * Set moyenDePaiement
     *
     * @param string $moyenDePaiement
     *
     * @return Donateurs
     */
    public function setMoyenDePaiement($moyenDePaiement)
    {
        $this->moyenDePaiement = $moyenDePaiement;

        return $this;
    }

    /**
     * Get moyenDePaiement
     *
     * @return string
     */
    public function getMoyenDePaiement()
    {
        return $this->moyenDePaiement;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Donateurs
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
     * Set evenement
     *
     * @param \Alfitra\CptBundle\Entity\Evenement $evenement
     *
     * @return Donateurs
     */
    public function setEvenement(\Alfitra\CptBundle\Entity\Evenement $evenement)
    {
        $this->evenement = $evenement;

        return $this;
    }

    /**
     * Get evenement
     *
     * @return \Alfitra\CptBundle\Entity\Evenement
     */
    public function getEvenement()
    {
        return $this->evenement;
    }

    /**
     * Set collecteur
     *
     * @param \Alfitra\CptBundle\Entity\Collecteur $collecteur
     *
     * @return Donateurs
     */
    public function setCollecteur(\Alfitra\CptBundle\Entity\Collecteur $collecteur)
    {
        $this->collecteur = $collecteur;

        return $this;
    }

    /**
     * Get collecteur
     *
     * @return \Alfitra\CptBundle\Entity\Collecteur
     */
    public function getCollecteur()
    {
        return $this->collecteur;
    }
}
