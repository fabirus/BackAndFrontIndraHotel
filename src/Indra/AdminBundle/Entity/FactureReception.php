<?php

namespace Indra\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

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
    private $statut = 1;

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
    private $paye = 1;


    /**
     * @ORM\ManyToOne(targetEntity="Chambre")
     */
    private $chambre;


    /**
     * @ORM\ManyToOne(targetEntity="Client")
     */
    private $client;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtePers", type="integer")
     */
    private $qtePers = 1;


    /**
     * @var boolean
     *
     * @ORM\Column(name="del", type="boolean")
     */
    private $del = 0;


    /**
     * @var string
     *
     * @ORM\Column(name="receptionniste", type="string")
     */
    private $receptionniste;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    private $updatedAt;


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
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return boolean
     */
    public function isDel()
    {
        return $this->del;
    }

    /**
     * @param boolean $del
     */
    public function setDel($del)
    {
        $this->del = $del;
    }

    /**
     * @return int
     */
    public function getQtePers()
    {
        return $this->qtePers;
    }

    /**
     * @param int $qtePers
     */
    public function setQtePers($qtePers)
    {
        $this->qtePers = $qtePers;
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

