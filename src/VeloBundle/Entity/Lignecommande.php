<?php

namespace VeloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lignecommande
 *
 * @ORM\Table(name="lignecommande")
 * @ORM\Entity
 */
class Lignecommande
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
     * @var integer
     *
     * @ORM\Column(name="idCommande", type="integer", nullable=false)
     */
    private $idcommande;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEquipement", type="integer", nullable=false)
     */
    private $idequipement;

    /**
     * @var integer
     *
     * @ORM\Column(name="prixUnitaire", type="integer", nullable=false)
     */
    private $prixunitaire;

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
     * @return int
     */
    public function getIdcommande()
    {
        return $this->idcommande;
    }

    /**
     * @param int $idcommande
     */
    public function setIdcommande($idcommande)
    {
        $this->idcommande = $idcommande;
    }

    /**
     * @return int
     */
    public function getIdequipement()
    {
        return $this->idequipement;
    }

    /**
     * @param int $idequipement
     */
    public function setIdequipement($idequipement)
    {
        $this->idequipement = $idequipement;
    }

    /**
     * @return int
     */
    public function getPrixunitaire()
    {
        return $this->prixunitaire;
    }

    /**
     * @param int $prixunitaire
     */
    public function setPrixunitaire($prixunitaire)
    {
        $this->prixunitaire = $prixunitaire;
    }


}

