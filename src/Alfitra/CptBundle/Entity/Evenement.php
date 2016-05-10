<?php

namespace Alfitra\CptBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="Alfitra\CptBundle\Repository\EvenementRepository")
 */
class Evenement
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
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;


    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="datetime")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fin", type="datetime", nullable=true)
     */
    private $fin;

    /**
     * @var int
     *
     * @ORM\Column(name="totalDonateurs", type="integer")
     */
    private $totalDonateurs;

    /**
     * @var int
     *
     * @ORM\Column(name="totalDons", type="integer")
     */
    private $totalDons;

    /**
     * @var int
     *
     * @ORM\Column(name="totalCash", type="integer")
     */
    private $totalCash;

    /**
     * @var int
     *
     * @ORM\Column(name="totalCb", type="integer")
     */
    private $totalCb;

    /**
     * @var int
     *
     * @ORM\Column(name="totalChq", type="integer")
     */
    private $totalChq;

    /**
     * @var int
     *
     * @ORM\Column(name="donMax", type="integer")
     */
    private $donMax;

    public function __construct(){
        $this->debut = new \DateTime();
        $this->totalDonateurs = 0;
        $this->totalDons = 0;
        $this->totalChq = 0;
        $this->totalCb = 0;
        $this->totalCash = 0;
        $this->donMax = 0;

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
     * Set nom
     *
     * @param string $nom
     *
     * @return Evenement
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
     * Set debut
     *
     * @param \DateTime $debut
     *
     * @return Evenement
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \DateTime $fin
     *
     * @return Evenement
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \DateTime
     */
    public function getFin()
    {
        return $this->fin;
    }

    /**
     * Set totalDonateurs
     *
     * @param integer $totalDonateurs
     *
     * @return Evenement
     */
    public function setTotalDonateurs($totalDonateurs)
    {
        $this->totalDonateurs = $totalDonateurs;

        return $this;
    }

    /**
     * Get totalDonateurs
     *
     * @return int
     */
    public function getTotalDonateurs()
    {
        return $this->totalDonateurs;
    }

    /**
     * Set totalDons
     *
     * @param integer $totalDons
     *
     * @return Evenement
     */
    public function setTotalDons($totalDons)
    {
        $this->totalDons = $totalDons;

        return $this;
    }

    /**
     * Get totalDons
     *
     * @return int
     */
    public function getTotalDons()
    {
        return $this->totalDons;
    }

    /**
     * Set totalCash
     *
     * @param integer $totalCash
     *
     * @return Evenement
     */
    public function setTotalCash($totalCash)
    {
        $this->totalCash = $totalCash;

        return $this;
    }

    /**
     * Get totalCash
     *
     * @return int
     */
    public function getTotalCash()
    {
        return $this->totalCash;
    }

    /**
     * Set totalCb
     *
     * @param integer $totalCb
     *
     * @return Evenement
     */
    public function setTotalCb($totalCb)
    {
        $this->totalCb = $totalCb;

        return $this;
    }

    /**
     * Get totalCb
     *
     * @return int
     */
    public function getTotalCb()
    {
        return $this->totalCb;
    }

    /**
     * Set totalChq
     *
     * @param integer $totalChq
     *
     * @return Evenement
     */
    public function setTotalChq($totalChq)
    {
        $this->totalChq = $totalChq;

        return $this;
    }

    /**
     * Get totalChq
     *
     * @return int
     */
    public function getTotalChq()
    {
        return $this->totalChq;
    }

    /**
     * Set donMax
     *
     * @param integer $donMax
     *
     * @return Evenement
     */
    public function setDonMax($donMax)
    {
        $this->donMax = $donMax;

        return $this;
    }

    /**
     * Get donMax
     *
     * @return int
     */
    public function getDonMax()
    {
        return $this->donMax;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }
}
