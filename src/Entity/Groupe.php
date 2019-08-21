<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groupe
 *
 * @ORM\Table(name="groupe", uniqueConstraints={@ORM\UniqueConstraint(name="GROUPE_PK", columns={"CODEGR"})})
 * @ORM\Entity
 */
class Groupe
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODEGR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codegr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LIBELLEGR", type="string", length=255, nullable=true)
     */
    private $libellegr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NIVEAUXGR", type="string", length=255, nullable=true)
     */
    private $niveauxgr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ANNEESCOGR", type="string", length=250, nullable=true)
     */
    private $anneescogr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FILLIEREGR", type="string", length=100, nullable=true)
     */
    private $fillieregr;
    public function __construct()
    {
        $this->codegr = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCodegr(): int
    {
        return $this->codegr;
    }

    /**
     * @param int $codegr
     */
    public function setCodegr(int $codegr): void
    {
        $this->codegr = $codegr;
    }

    /**
     * @return null|string
     */
    public function getLibellegr(): ?string
    {
        return $this->libellegr;
    }

    /**
     * @param null|string $libellegr
     */
    public function setLibellegr(?string $libellegr): void
    {
        $this->libellegr = $libellegr;
    }

    /**
     * @return null|string
     */
    public function getNiveauxgr(): ?string
    {
        return $this->niveauxgr;
    }

    /**
     * @param null|string $niveauxgr
     */
    public function setNiveauxgr(?string $niveauxgr): void
    {
        $this->niveauxgr = $niveauxgr;
    }

    /**
     * @return null|string
     */
    public function getAnneescogr(): ?string
    {
        return $this->anneescogr;
    }

    /**
     * @param null|string $anneescogr
     */
    public function setAnneescogr(?string $anneescogr): void
    {
        $this->anneescogr = $anneescogr;
    }

    /**
     * @return null|string
     */
    public function getFillieregr(): ?string
    {
        return $this->fillieregr;
    }

    /**
     * @param null|string $fillieregr
     */
    public function setFillieregr(?string $fillieregr): void
    {
        $this->fillieregr = $fillieregr;
    }


}
