<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName',TextType::class, array(
                'label'=> 'Nom',
                'attr'=> ['placeholder'=>'Votre Non']
            ))
            ->add('firstName',TextType::class, array(
                'label'=> 'Prénom',
                'attr'=> ['placeholder'=>'Votre Prénom']
            ))
            ->add('username',TextType::class, array(
                'label'=> 'Nom d\'utilisateur',
                'attr'=> ['placeholder'=>'Non d\'utilisateur ']
            ))
            ->add('email',EmailType::class, array(
                'label'=> 'Email',
                'attr'=> ['placeholder'=>'Votre Email']
            ))
            ->add('adresse',TextType::class, array(
                'label'=> 'Votre Adresse',
                'attr'=> ['placeholder'=>'Votre Adresse']
            ))
            ->add('ville',TextType::class, array(
                'label'=> 'Ville',
                'attr'=> ['placeholder'=>'Votre Ville']
            ))
            ->add('pays',CountryType::class, array(
                'label'=> 'Pays',
                'attr'=> ['placeholder'=>'Votre Pays'],
                'preferred_choices' => ['FR']
            ))
            ->add('codePostal',TextType::class, array(
                'label'=> 'Code Postal',
                'attr'=> ['placeholder'=>'Code Postal']
            ))
            ->add('telephone',TextType::class, array(
                'label'=> 'Télephone',
                'attr'=> ['placeholder'=>'Votre telephone']
            ))
            ->add('dateAnniversaire', BirthdayType::class, array(
                'label'=> 'Date D\'anniversaire',
                'placeholder' => array(
                    'day'=>'Jour','month'=>'Mois' ,'year'=>'Année'
                )
            ))
            ->add('attachment',FileType::class,array(
                'label' => 'Photo de profil',
                'required' => false,
            ))->getForm()
        ;
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user';
    }


}
