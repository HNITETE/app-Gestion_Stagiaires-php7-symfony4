<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Module
 *
 * @ORM\Table(name="module", uniqueConstraints={@ORM\UniqueConstraint(name="MODULE_PK", columns={"CODEMO"})})
 * @ORM\Entity
 */
class Module
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODEMO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codemo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LIBELLEMO", type="string", length=255, nullable=true)
     */
    private $libellemo;

    /**
     * @var string
     *
     * @ORM\Column(name="DATEMO", type="string", length=100, nullable=false)
     */
    private $datemo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="MASSEHMO", type="integer", nullable=true)
     */
    private $massehmo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCMO", type="string", length=255, nullable=true)
     */
    private $descmo;

    /**
     * @var \Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODEGR", referencedColumnName="CODEGR")
     * })
     */
    private $codegr;

    /**
     * @return int
     */
    public function getCodemo(): ?int
    {
        return $this->codemo;
    }

    /**
     * @param int $codemo
     */
    public function setCodemo(int $codemo): void
    {
        $this->codemo = $codemo;
    }

    /**
     * @return null|string
     */
    public function getLibellemo(): ?string
    {
        return $this->libellemo;
    }

    /**
     * @param null|string $libellemo
     */
    public function setLibellemo(?string $libellemo): void
    {
        $this->libellemo = $libellemo;
    }

    /**
     * @return string
     */
    public function getDatemo(): ?string
    {
        return $this->datemo;
    }

    /**
     * @param string $datemo
     */
    public function setDatemo(string $datemo): void
    {
        $this->datemo = $datemo;
    }

    /**
     * @return int|null
     */
    public function getMassehmo(): ?int
    {
        return $this->massehmo;
    }

    /**
     * @param int|null $massehmo
     */
    public function setMassehmo(?int $massehmo): void
    {
        $this->massehmo = $massehmo;
    }

    /**
     * @return null|string
     */
    public function getDescmo(): ?string
    {
        return $this->descmo;
    }

    /**
     * @param null|string $descmo
     */
    public function setDescmo(?string $descmo): void
    {
        $this->descmo = $descmo;
    }

    /**
     * @return \Groupe
     */
    public function getCodegr(): ?Groupe
    {
        return $this->codegr;
    }

    /**
     * @param \Groupe $codegr
     */
    public function setCodegr(?Groupe $codegr): void
    {
        $this->codegr = $codegr;
    }


}
