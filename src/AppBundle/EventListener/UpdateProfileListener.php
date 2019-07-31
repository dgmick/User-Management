<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 27/07/2019
 * Time: 12:37
 */
namespace AppBundle\EventListener;

use AppBundle\Service\MailerHandler;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UpdateProfileListener implements EventSubscriberInterface
{
    /** @var MailerHandler */
    protected $mailerHandler;

    public function __construct(MailerHandler $mailerHandler)
    {
        $this->mailerHandler = $mailerHandler;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'registrationSuccess'
        );
    }

    /**
     * @param FormEvent $event
     */
    public function registrationSuccess(FormEvent $event)
    {
        $user = $event->getForm()->getData();

        $this->mailerHandler->registrationSuccess($user);
    }
}
