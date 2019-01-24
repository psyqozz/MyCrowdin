<?php
// src/Entity/User.php
namespace App\Entity;

use App\Entity\Langage;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Cet Email existe déjà.")
 * @UniqueEntity(fields="username", message="Cet utilisateur existe déjà.")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
    * @ORM\ManyToMany(targetEntity="App\Entity\Langage", cascade={"persist"})
    */
    private $langages;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    public function __construct() {
        $this->roles = array('ROLE_USER');
    }

    // other properties and methods
    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
	
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        // Afin d'être sûr qu'un user a toujours au moins 1 rôle
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }
        
        return $this->roles;
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
       
        return $this;
    }

    public function removeRole($role)
    {
            // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
            $this->roles->removeElement($role);
    }

    public function getLangages()
    {
        return $this->langages;
    }

    public function addLangage(Langage $langage)
    {
        if (!$this->langages->contains($langage)) {
            // Ici, on utilise l'ArrayCollection vraiment comme un tableau
            $this->langages[] = $langage;
        }

        return $this;
    }

    public function removeLangage(Langage $langage)
    {
        if ($this->langages->contains($langage)) {
            // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
            $this->langages->removeElement($langage);
        }
    }

    public function eraseCredentials()
    {

    }
}
