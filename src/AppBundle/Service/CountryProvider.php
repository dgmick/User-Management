<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 08/07/2019
 * Time: 19:22
 */

namespace AppBundle\Service;

use AppBundle\Entity\CountryInterface;

class CountryProvider
{
    /** @var string */
    protected $className;

    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * @return CountryInterface
     */
    public function createCountry()
    {
        return new $this->className;
    }
}
