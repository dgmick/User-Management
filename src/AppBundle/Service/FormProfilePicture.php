<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 29/07/2019
 * Time: 14:19
 */
namespace AppBundle\Service;

use UserBundle\Form\ProfilePictureType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Form\FormFactoryInterface;

class FormProfilePicture
{
    private $form;

    private $router;

    private $formFactory;

    public function __construct(UrlGeneratorInterface $router, FormFactoryInterface $formFactory)
    {
        $this->router = $router;

        $this->formFactory = $formFactory;

        $this->form = $this->formFactory->create(
            ProfilePictureType::class,
            null,
            array(
                'attr' =>
                    array(
                        'action' => $this->router->generate('profilepicture')
                    )
            )
        );
    }

    public function getForm()
    {
        return $this->form;
    }
}
