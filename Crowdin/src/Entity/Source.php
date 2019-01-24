<?php

namespace App\Entity;

use App\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceRepository")
 */
class Source
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langue;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $file_source;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $oneSource;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project")
     * @ORM\JoinColumn(nullable=false)
     */
    private $project;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function getFileSource()
    {
        return $this->file_source;
    }

    public function getProject()
    {   
	return $this->project;
    }	

    public function getOneSource()
    {
	return $this->oneSource;
    }

    public function setOneSource($oneSource)
    {
	$this->oneSource = $oneSource;
	return $this;
    }
    public function setProject(Project $project)
    {
	$this->project = $project;
	return $this;
    }
    
    public function setLangue(?string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function setFileSource($file_source): self
    {
        $this->file_source = $file_source;

        return $this;
    }

    /**
     * @return Collection|SourceTranslated[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(SourceTranslated $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setSource($this);
        }

        return $this;
    }

    public function removeUser(SourceTranslated $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getSource() === $this) {
                $user->setSource(null);
            }
        }

        return $this;
    }
}
