<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 05/06/2019
 * Time: 03:25
 */

namespace AppBundle\Entity;

interface LanguageInterface
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
}
