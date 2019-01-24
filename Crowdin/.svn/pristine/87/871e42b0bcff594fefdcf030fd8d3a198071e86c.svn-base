<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
     
    /**
     * @ORM\Column(type="string", length=64)
     */
    private $nameProject;

    /**
     *  @ORM\ManyToOne(targetEntity="App\Entity\Langage", cascade={"persist"})
     */
    private $langOrigin;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $statut;
    
    /**
     *
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->date = new \Datetime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }
    
    public function getNameProject(): ?string
    {
        return $this->nameProject;
    }

    public function setNameProject(string $nameProject): self
    {
        $this->nameProject = $nameProject;

        return $this;
    }

    public function getLangOrigin()
    {
        return $this->langOrigin;
    }

    public function setLangOrigin(Langage $langOrigin)
    {
        $this->langOrigin = $langOrigin;

        return $this;
    }

    public function getStatut()
    {
	return $this->statut;
    }

    public function setStatut($stat)
    {
	$this->statut = $stat;

	return $this;
    }
    
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }
}
