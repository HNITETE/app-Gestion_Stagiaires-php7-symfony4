<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seance
 *
 * @ORM\Table(name="seance", uniqueConstraints={@ORM\UniqueConstraint(name="SEANCE_PK", columns={"CODESE"})})
 * @ORM\Entity
 */
class Seance
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODESE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codese;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DATESE", type="string", length=100, nullable=true)
     */
    private $datese;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HEUREDBSE", type="time", nullable=true)
     */
    private $heuredbse;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="HEUREFNSE", type="time", nullable=true)
     */
    private $heurefnse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RESMMESE", type="text", length=16777215, nullable=true)
     */
    private $resmmese;

    /**
     * @var \Module
     *
     * @ORM\ManyToOne(targetEntity="Module")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODEMO", referencedColumnName="CODEMO")
     * })
     */
    private $codemo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Stagiaire", inversedBy="codese")
     * @ORM\JoinTable(name="assister",
     *   joinColumns={
     *     @ORM\JoinColumn(name="CODESE", referencedColumnName="CODESE")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="CODEST", referencedColumnName="CODEST")
     *   }
     * )
     */
    private $codest;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codest = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCodest(): \Doctrine\Common\Collections\Collection
    {
        return $this->codest;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $codest
     */
    public function setCodest(\Doctrine\Common\Collections\Collection $codest): void
    {
        $this->codest = $codest;
    }

    /**
     * @return int
     */
    public function getCodese(): int
    {
        return $this->codese;
    }

    /**
     * @param int $codese
     */
    public function setCodese(int $codese): void
    {
        $this->codese = $codese;
    }

    /**
     * @return null|string
     */
    public function getDatese(): ?string
    {
        return $this->datese;
    }

    /**
     * @param null|string $datese
     */
    public function setDatese(?string $datese): void
    {
        $this->datese = $datese;
    }

    /**
     * @return \DateTime|null
     */
    public function getHeuredbse(): ?\DateTime
    {
        return $this->heuredbse;
    }

    /**
     * @param \DateTime $heuredbse
     */
    public function setHeuredbse(?DateTime $heuredbse): void
    {
        $this->heuredbse = $heuredbse;
    }

    /**
     * @return \DateTime|null
     */
    public function getHeurefnse(): ?\DateTime
    {
        return $this->heurefnse;
    }

    /**
     * @param \DateTime|null $heurefnse
     */
    public function setHeurefnse(?\DateTime $heurefnse): void
    {
        $this->heurefnse = $heurefnse;
    }

    /**
     * @return null|string
     */
    public function getResmmese(): ?string
    {
        return $this->resmmese;
    }

    /**
     * @param null|string $resmmese
     */
    public function setResmmese(?string $resmmese): void
    {
        $this->resmmese = $resmmese;
    }

    /**
     * @return \Module
     */
    public function getCodemo(): ?Module
    {
        return $this->codemo;
    }

    /**
     * @param \Module $codemo
     */
    public function setCodemo(?Module $codemo): void
    {
        $this->codemo = $codemo;
    }


}
