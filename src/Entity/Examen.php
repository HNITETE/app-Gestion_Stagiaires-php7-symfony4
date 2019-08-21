<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Seance;

/**
 * Examen
 *
 * @ORM\Table(name="examen", uniqueConstraints={@ORM\UniqueConstraint(name="EXAMEN_PK", columns={"CODEEX"})}, indexes={@ORM\Index(name="PASSER_FK", columns={"CODE_SE"})})
 * @ORM\Entity
 */
class Examen
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODEEX", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codeex;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="DATEEX", type="date", nullable=true)
     */
    private $dateex;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TYPEEX", type="string", length=255, nullable=true)
     */
    private $typeex;

    /**
     * @var \Seance
     *
     * @ORM\ManyToOne(targetEntity="Seance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODE_SE", referencedColumnName="CODESE")
     * })
     */
    private $codeSe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Stagiaire", mappedBy="codeex")
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
     * @return \Seance
     */
    public function getCodeSe(): ?Seance
    {
        return $this->codeSe;
    }

    /**
     * @param \Seance $codeSe
     */
    public function setCodeSe(\Seance $codeSe): void
    {
        $this->codeSe = $codeSe;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateex(): ?\DateTime
    {
        return $this->dateex;
    }

    /**
     * @param \DateTime|null $dateex
     */
    public function setDateex(?\DateTime $dateex): void
    {
        $this->dateex = $dateex;
    }

    /**
     * @return null|string
     */
    public function getTypeex(): ?string
    {
        return $this->typeex;
    }

    /**
     * @param null|string $typeex
     */
    public function setTypeex(?string $typeex): void
    {
        $this->typeex = $typeex;
    }

    /**
     * @return int
     */
    public function getCodeex(): int
    {
        return $this->codeex;
    }

    /**
     * @param int $codeex
     */
    public function setCodeex(int $codeex): void
    {
        $this->codeex = $codeex;
    }

}
