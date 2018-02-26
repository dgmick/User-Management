<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="last_name" , type="string" , length=25, nullable=true)
     */
    protected $lastName;

    /**
     * @var string
     * @ORM\Column(name="first_name", type="string", length=25, nullable=true)
     */
    protected $firstName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="date_anniversaire", type="datetime", nullable = true)
     */
    protected $dateAnniversaire;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    protected $adresse;

    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=25, nullable=true)
     */
    protected $ville;

    /**
     * @var string
     * @ORM\Column(name="pays", type="string", length=50, nullable=true)
     */
    protected $pays;

    /**
     * @var string
     * @ORM\Column(name="code_postal", type="string",length=5, nullable=true)
     */
    protected $codePostal;

    /**
     * @var string
     * @ORM\Column(name="telephone", type="string", length=15, nullable=true)
     */
    protected $telephone;

    /**
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\User", cascade={"persist"})
     */
    protected $users;


    /**
     * @var string
     *
     * @ORM\Column(name="illustration", type="string", nullable=true)
     */
    private $illustration;


    /**
     *@Assert\File(
     *     mimeTypes={"image/jpeg","image/gif","image/png"},
     *     mimeTypesMessage = "Svp inserer une image valide (png,jpg,jpeg)")
     */
    private $attachment;
    

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", nullable=true)
     */
    protected $facebookId;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", nullable=true)
     */
    protected $googleId;

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getDateAnniversaire()
    {
        return $this->dateAnniversaire;
    }

    /**
     * @param string $dateAnniversaire
     */
    public function setDateAnniversaire($dateAnniversaire)
    {
        $this->dateAnniversaire = $dateAnniversaire;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * @param string $pays
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    }

    /**
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param string $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }
    

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }


    /**
     * Add user
     */
    public function addUser($user)
    {
        $this->users[] = $user;

    }

    /**
     * Remove user
     */
    public function removeUser($user)
    {
        $this->users->removeElement($user);
    }

    /**
     * @return string
     */
    public function getIllustration()
    {
        return $this->illustration;
    }

    /**
     * @param string $illustration
     */
    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
    }

    /**
     * @return mixed
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param mixed $attachment
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * @param string $googleId
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
    }


    

    
    
}
