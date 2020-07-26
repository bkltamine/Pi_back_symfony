<?php

namespace VeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Station
 *
 * @ORM\Table(name="station")
 * @ORM\Entity
 */
class Station
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
     * @ORM\Column(name="nomStation", type="string", length=300, nullable=false)
     */
    private $nomstation;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=300, nullable=false)
     */
    private $lieu;

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
    public function getNomstation()
    {
        return $this->nomstation;
    }

    /**
     * @param string $nomstation
     */
    public function setNomstation($nomstation)
    {
        $this->nomstation = $nomstation;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }


}

