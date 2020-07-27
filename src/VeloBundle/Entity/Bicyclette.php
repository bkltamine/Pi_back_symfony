<?php

namespace VeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bicyclette
 *
 * @ORM\Table(name="bicyclette", indexes={@ORM\Index(name="idStation", columns={"idStation"})})
 * @ORM\Entity
 */
class Bicyclette
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
     * @ORM\Column(name="model", type="string", length=300, nullable=false)
     */
    private $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="age", type="integer", nullable=false)
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=300, nullable=false)
     */
    private $reference;

    /**
     * @var integer
     *
     * @ORM\Column(name="idStation", type="integer", nullable=false)
     */
    private $idstation;

    /**
     * @var integer
     *
     * @ORM\Column(name="prixParHeure", type="integer", nullable=false)
     */
    private $prixParHeure;

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
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return int
     */
    public function getIdstation()
    {
        return $this->idstation;
    }

    /**
     * @param int $idstation
     */
    public function setIdstation($idstation)
    {
        $this->idstation = $idstation;
    }

    /**
     * @return int
     */
    public function getPrixparheure()
    {
        return $this->prixParHeure;
    }

    /**
     * @param int $prixParHeure
     */
    public function setPrixparheure($prixParHeure)
    {
        $this->prixParHeure = $prixParHeure;
    }


}

