<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 29/07/2019
 * Time: 14:59
 */
namespace AppBundle\Twig;

use AppBundle\Service\FormProfilePicture;

class ProfilePictureExtension extends \Twig_Extension
{
    protected $formProfilePicture;

    public function __construct(FormProfilePicture $formProfilePicture)
    {
        $this->formProfilePicture = $formProfilePicture;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('profilePicture', array($this, 'profilePicture'))
        );
    }

    /**
     * @return \Symfony\Component\Form\FormView
     */
    public function profilePicture()
    {
        $form = $this->formProfilePicture->getForm();
        return $form->createView();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'access';
    }
}
