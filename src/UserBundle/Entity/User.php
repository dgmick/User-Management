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
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\Member", mappedBy="user", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    protected $member;

    public function __construct()
    {
        parent::__construct();
        $this->member = new ArrayCollection();
    }
        


    /**
     * Add member
     *
     * @param \UserBundle\Entity\Member $member
     *
     * @return User
     */
    public function addMember(\UserBundle\Entity\Member $member)
    {
        $this->member[] = $member;

        return $this;
    }

    /**
     * Remove member
     *
     * @param \UserBundle\Entity\Member $member
     */
    public function removeMember(\UserBundle\Entity\Member $member)
    {
        $this->member->removeElement($member);
    }

    /**
     * Get member
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMember()
    {
        return $this->member;
    }
}
