<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 27/07/2019
 * Time: 12:26
 */

namespace AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use UserBundle\Model\UserInterface;

class UserEvent extends Event
{
    /** @var UserInterface */
    protected $user;

    /**
     * UserEvent constructor.
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
