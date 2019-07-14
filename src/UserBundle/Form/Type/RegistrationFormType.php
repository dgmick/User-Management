<?php

namespace UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, array(
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre Prénom',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('lastName', TextType::class, array(
                'label' => false,
                'attr' => ['placeholder' => 'Votre Nom',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('phone', TextType::class, array(
                'label' => false,
                'attr' => ['placeholder' => 'Votre Numéro',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('Birthday', DateType::class, array(
                'label' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'form-control input-lg']
            ))
            ->add('Address', TextType::class, array(
                'label' => false,
                'attr' => ['placeholder' => 'Votre Adresse',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('country', null, array(
                'label' => false,
                'multiple' => false,
                'required' => true,
                'attr' => ['class' => 'select2 form-control input-lg']
            ))
            ->add('username', TextType::class, array(
                'label' => false,
                'attr' => ['placeholder' => 'Non d\'utilisateur ',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => ['placeholder' => 'Votre Email',
                    'class' => 'form-control input-lg'
                ]
            ))
            ->add('imagesId', FileType::class, array(
                'label' => 'Image de profile',
                'required' => false,
                'data_class' => null
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => false, 'attr' => ['placeholder' => 'Mot de passe',
                    'class' => 'form-control input-lg']),
                'second_options' => array('label' => false, 'attr' => ['placeholder' => 'Répéter le mot de passe',
                    'class' => 'form-control input-lg']),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}
