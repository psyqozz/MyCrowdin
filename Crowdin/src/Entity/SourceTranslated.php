<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceTranslatedRepository")
 */
class SourceTranslated
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="user")
     * @ORM\JoinColumn(nullable=false)
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valueTranslated;

    /**
     * @ORM\Column(type="string" , length=255)
     */
     private $langTranslate;
     
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

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getLangTranslate()
    {
	    return $this->langTranslate;
    }

    public function setLangTranslate($lang)
    {
	    $this->langTranslate = $lang;
	
	    return $this;
    }
    
    public function getValueTranslated(): ?string
    {
        return $this->valueTranslated;
    }

    public function setValueTranslated(string $valueTranslated): self
    {
        $this->valueTranslated = $valueTranslated;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }	
}

