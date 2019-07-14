<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 05/06/2019
 * Time: 01:25
 */

namespace UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\UserInterface as FOSUserInterface;

interface UserInterface extends FOSUserInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param string $email
     * @return User
     */
    public function setEmail($email);

    /**
     * @param string $emailCanonical
     * @return User
     */
    public function setEmailCanonical($emailCanonical);

    /**
     * @return string
     */
    public function getFullName();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     * @return UserInterface
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     * @return UserInterface
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     * @return UserInterface
     */
    public function setPhone($phone);

    /**
     * @return \DateTime
     */
    public function getBirthday();

    /**
     * @param \DateTime $birthday
     * @return UserInterface
     */
    public function setBirthday($birthday);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param string $address
     * @return UserInterface
     */
    public function setAddress($address);

    /**
     * @return ArrayCollection
     */
    public function getCountry();

    /**
     * @param array $country
     * @return UserInterface
     */
    public function setCountry($country);
}
