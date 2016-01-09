<?php

namespace Indra\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureReception
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Indra\AdminBundle\Entity\Repository\FactureReceptionRepository")
 */
class FactureReception
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="statut", type="boolean")
     */
    private $statut;

    /**
     * @var string
     *
     * @ORM\Column(name="dateArrive", type="string")
     */
    private $dateArrive;


    /**
     * @var string
     *
     * @ORM\Column(name="dateDepart", type="string")
     */
    private $dateDepart;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paye", type="boolean")
     */
    private $paye;


    /**
     * @ORM\ManyToOne(targetEntity="Chambre")
     */
    private $chambre;


    /**
     * @ORM\ManyToOne(targetEntity="Client")
     */
    private $client;


    /**
     * @var string
     *
     * @ORM\Column(name="receptionniste", type="string")
     */
    private $receptionniste;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDateArrive()
    {
        return $this->dateArrive;
    }

    /**
     * @param string $dateArrive
     */
    public function setDateArrive($dateArrive)
    {
        $this->dateArrive = $dateArrive;
    }

    /**
     * @return string
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * @param string $dateDepart
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    }


    /**
     * @return boolean
     */
    public function isPaye()
    {
        return $this->paye;
    }

    /**
     * @param boolean $paye
     */
    public function setPaye($paye)
    {
        $this->paye = $paye;
    }

    /**
     * @return mixed
     */
    public function getChambre()
    {
        return $this->chambre;
    }

    /**
     * @param mixed $chambre
     */
    public function setChambre($chambre)
    {
        $this->chambre = $chambre;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getReceptionniste()
    {
        return $this->receptionniste;
    }

    /**
     * @param string $receptionniste
     */
    public function setReceptionniste($receptionniste)
    {
        $this->receptionniste = $receptionniste;
    }


    /**
     * Set statut
     *
     * @param boolean $statut
     *
     * @return FactureReception
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return boolean
     */
    public function getStatut()
    {
        return $this->statut;
    }
}

