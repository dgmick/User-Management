<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 05/06/2019
 * Time: 03:08
 */

namespace AppBundle\Entity;

interface CountryInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return self
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @param string $language
     * @return self
     */
    public function setLanguage($language);
}
