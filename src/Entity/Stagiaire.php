<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Stagiaire
 *
 * @ORM\Table(name="stagiaire", uniqueConstraints={@ORM\UniqueConstraint(name="STAGIAIRE_PK", columns={"CODEST"})}, indexes={@ORM\Index(name="APPARTENIR_FK", columns={"CODEGR"})})
 * @ORM\Entity
*/


class Stagiaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODEST", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codest;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMST", type="string", length=255, nullable=true)
     */
    private $nomst;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PRENOMST", type="string", length=255, nullable=true)
     */
    private $prenomst;

    /**
     * @var string
     *
     * @ORM\Column(name="DATENSST", type="string", length=100 , nullable=true)
     */
    private $datensst;

    /**
     * @var string|null
     *
     * @ORM\Column(name="SEXEST", type="string", length=30, nullable=true)
     */
    private $sexest;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="Phone", type="integer", nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="CIN", type="string", length=20, nullable=false)
     */
    private $cin;

    /**
     * @var Groupe
     *
     * @ORM\ManyToOne(targetEntity="Groupe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODEGR", referencedColumnName="CODEGR")
     * })
     */
    private $codegr;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Seance", mappedBy="codest")
     */
    private $codese;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Examen", inversedBy="codest")
     * @ORM\JoinTable(name="controler",
     *   joinColumns={
     *     @ORM\JoinColumn(name="CODEST", referencedColumnName="CODEST")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="CODEEX", referencedColumnName="CODEEX")
     *   }
     * )
     */
    private $codeex;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->codese = new \Doctrine\Common\Collections\ArrayCollection();
        $this->codeex = new \Doctrine\Common\Collections\ArrayCollection();
        $this->codegr = new Groupe();
    }

    /**
     * @return int
     */
    public function getCodest(): int
    {
        return $this->codest;
    }

    /**
     * @param int $codest
     */
    public function setCodest(int $codest): void
    {
        $this->codest = $codest;
    }

    /**
     * @return null|string
     */
    public function getNomst(): ?string
    {
        return $this->nomst;
    }

    /**
     * @param null|string $nomst
     */
    public function setNomst(?string $nomst): void
    {
        $this->nomst = $nomst;
    }

    /**
     * @return null|string
     */
    public function getPrenomst(): ?string
    {
        return $this->prenomst;
    }

    /**
     * @param null|string $prenomst
     */
    public function setPrenomst(?string $prenomst): void
    {
        $this->prenomst = $prenomst;
    }

    /**
     * @return null|string
     */
    public function getDatensst(): ?string
    {
        return $this->datensst;
    }

    /**
     * @param null|string $datemo
     */
    public function setDatensst(string $datensst): void
    {
        $this->datensst = $datensst;
    }

    /**
     * @return null|string
     */
    public function getSexest(): ?string
    {
        return $this->sexest;
    }

    /**
     * @param null|string $sexest
     */
    public function setSexest(?string $sexest): void
    {
        $this->sexest = $sexest;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return null|int
     */
    public function getPhone(): ?int
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone(int $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return null|string
     */
    public function getCin(): ?string
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     */
    public function setCin(string $cin): void
    {
        $this->cin = $cin;
    }

    /**
     * @return \Groupe
     */
    public function getCodegr(): ?Groupe
    {
        return $this->codegr;
    }

    /**
     * @param \Groupe
     */
    public function setCodegr(?Groupe $codegr): void
    {
        $this->codegr = $codegr;
    }
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\File(mimeTypes={ "image/jpg","image/png"})
     */
    private $pic;

    public function getBrochure()
    {
        return $this->pic;
    }

    public function setBrochure($pic)
    {
        $this->pic = $pic;

        return $this;
    }
    public  function eraseCredentials(){}
    public  function getSalt(){}
    public  function getRoles(){
        return Roles['ROLE_STAGIAIRE'];
    }


}
