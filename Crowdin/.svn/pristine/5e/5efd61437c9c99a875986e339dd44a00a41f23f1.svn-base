<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LangageRepository")
 */
class Langage
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
    private $libelleLangage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleLangage(): ?string
    {
        return $this->libelleLangage;
    }

    public function setLibelleLangage(string $libelleLangage): self
    {
        $this->libelleLangage = $libelleLangage;

        return $this;
    }
}
