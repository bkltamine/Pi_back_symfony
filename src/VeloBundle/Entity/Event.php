<?php

namespace VeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event", indexes={@ORM\Index(name="idDestination", columns={"idDestination"}), @ORM\Index(name="idCategorie", columns={"idCategorie"}), @ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idGuide", columns={"idGuide"})})
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=300, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=6000, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedebut", type="datetime", nullable=false)
     */
    private $datedebut;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbparticipant", type="integer", nullable=false)
     */
    private $nbparticipant;





    /**
     * @var integer
     *
     * @ORM\Column(name="nbrpalcesreserv", type="integer", nullable=false)
     */
    private $nbrpalcesreserv;

    /**
     * @var integer
     *
     * @ORM\Column(name="idDestination", type="integer", nullable=false)
     */
    private $iddestination;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCategorie", type="integer", nullable=false)
     */
    private $idcategorie;

    /**
     * @var integer
     *
     * @ORM\Column(name="duree", type="integer", nullable=false)
     */
    private $duree;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idGuide", type="integer", nullable=false)
     */
    private $idguide;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param \DateTime $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return int
     */
    public function getNbparticipant()
    {
        return $this->nbparticipant;
    }

    /**
     * @param int $nbparticipant
     */
    public function setNbparticipant($nbparticipant)
    {
        $this->nbparticipant = $nbparticipant;
    }

    /**
     * @return int
     */
    public function getIddestination()
    {
        return $this->iddestination;
    }

    /**
     * @param int $iddestination
     */
    public function setIddestination($iddestination)
    {
        $this->iddestination = $iddestination;
    }

    /**
     * @return int
     */
    public function getIdcategorie()
    {
        return $this->idcategorie;
    }

    /**
     * @param int $idcategorie
     */
    public function setIdcategorie($idcategorie)
    {
        $this->idcategorie = $idcategorie;
    }

    /**
     * @return int
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return int
     */
    public function getIdguide()
    {
        return $this->idguide;
    }

    /**
     * @param int $idguide
     */
    public function setIdguide($idguide)
    {
        $this->idguide = $idguide;
    }

    /**
     * @return int
     */
    public function getNbrpalcesreserv()
    {
        return $this->nbrpalcesreserv;
    }

    /**
     * @param int $nbrpalcesreserv
     */
    public function setNbrpalcesreserv($nbrpalcesreserv)
    {
        $this->nbrpalcesreserv = $nbrpalcesreserv;
    }

    public function __toString()
    {
return $this->description  ; }


}

